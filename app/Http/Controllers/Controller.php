<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /**
     * Normalize text for fuzzy comparison:
     * - lowercase
     * - expand abbreviations (K.V. → kv, St. → st)
     * - remove special characters but keep spaces
     */
    protected function normalizeForFuzzy(string $text): string
    {
        $text = strtolower(trim($text));
        // Remove dots from abbreviations (K.V. → kv, B.Ed → bed)
        $text = preg_replace('/\.(?=\S)/', '', $text);
        $text = str_replace('.', ' ', $text);
        // Remove special chars except spaces and alphanumeric
        $text = preg_replace('/[^a-z0-9\s]/', '', $text);
        // Collapse multiple spaces
        $text = preg_replace('/\s+/', ' ', $text);
        return trim($text);
    }

    /**
     * Apply common Indian transliteration normalizations.
     * Maps phonetically similar spellings to a canonical form.
     */
    protected function phoneticNormalize(string $word): string
    {
        $replacements = [
            // Vowel variations
            'ay' => 'ai', 'ey' => 'i', 'ee' => 'i', 'oo' => 'u',
            'ou' => 'o', 'aa' => 'a', 'ii' => 'i', 'uu' => 'u',
            // Consonant variations common in Indian names
            'sh' => 's', 'th' => 't', 'dh' => 'd', 'bh' => 'b',
            'gh' => 'g', 'kh' => 'k', 'ph' => 'f', 'ch' => 'c',
            'ck' => 'k', 'qu' => 'k',
            // Common endings
            'pur' => 'pur', 'pura' => 'pur', 'puram' => 'pur',
            'abad' => 'abad', 'abad' => 'abad',
            'nagar' => 'nagr', 'nager' => 'nagr',
        ];

        foreach ($replacements as $from => $to) {
            $word = str_replace($from, $to, $word);
        }
        return $word;
    }

    /**
     * Perform fuzzy matching between a query and a target text.
     * Returns a score between 0 and 100 if there's a match, or 0 if no match.
     * Enhanced with abbreviation handling, phonetic similarity, and transliteration.
     */
    protected function fuzzyMatch(string $query, string $text): float
    {
        $query = strtolower(trim($query));
        $text = strtolower(trim($text));

        if (empty($query) || empty($text)) {
            return 0;
        }

        // Exact substring matches (original text)
        if (str_contains($text, $query)) {
            return str_starts_with($text, $query) ? 100 : 90;
        }

        // Normalize both for abbreviation-aware matching
        $normQuery = $this->normalizeForFuzzy($query);
        $normText = $this->normalizeForFuzzy($text);

        // Check normalized exact substring
        if (str_contains($normText, $normQuery)) {
            return str_starts_with($normText, $normQuery) ? 95 : 85;
        }

        // Phonetic normalization check
        $phoneticQuery = $this->phoneticNormalize($normQuery);
        $phoneticText = $this->phoneticNormalize($normText);
        if (str_contains($phoneticText, $phoneticQuery)) {
            return 80;
        }

        // Word-level matching with enhanced scoring
        $queryWords = preg_split('/\s+/', $normQuery);
        $textWords = preg_split('/\s+/', $normText);

        $matchedWordsCount = 0;
        $totalScore = 0;

        foreach ($queryWords as $qw) {
            if (strlen($qw) === 0) continue;
            $bestWordScore = 0;

            foreach ($textWords as $tw) {
                if (strlen($tw) === 0) continue;

                // Prefix match
                if (str_starts_with($tw, $qw)) {
                    $wordScore = 80 * (strlen($qw) / strlen($tw));
                    $bestWordScore = max($bestWordScore, $wordScore);
                }
                // Substring match
                elseif (str_contains($tw, $qw)) {
                    $wordScore = 70 * (strlen($qw) / strlen($tw));
                    $bestWordScore = max($bestWordScore, $wordScore);
                }
                // Phonetic word match
                elseif ($this->phoneticNormalize($qw) === $this->phoneticNormalize($tw)) {
                    $bestWordScore = max($bestWordScore, 65);
                }
                // Soundex match
                elseif (strlen($qw) >= 3 && strlen($tw) >= 3 && soundex($qw) === soundex($tw)) {
                    $bestWordScore = max($bestWordScore, 55);
                }
                // Typo-tolerant Levenshtein match (enhanced thresholds)
                else {
                    $lenQw = strlen($qw);
                    $lenTw = strlen($tw);
                    $maxLen = max($lenQw, $lenTw);
                    if ($maxLen > 0 && $maxLen < 255) {
                        $dist = levenshtein($qw, $tw);
                        // More generous: 1 typo for 3-4 chars, 2 for 5-7, 3 for 8+
                        $allowedTypos = match(true) {
                            $lenQw < 3 => 0,
                            $lenQw <= 4 => 1,
                            $lenQw <= 7 => 2,
                            default => 3,
                        };

                        if ($dist <= $allowedTypos) {
                            $similarity = 1 - ($dist / $maxLen);
                            $wordScore = 60 * $similarity;
                            $bestWordScore = max($bestWordScore, $wordScore);
                        }

                        // Also try phonetic-normalized Levenshtein
                        $pQw = $this->phoneticNormalize($qw);
                        $pTw = $this->phoneticNormalize($tw);
                        if ($pQw !== $qw || $pTw !== $tw) {
                            $pDist = levenshtein($pQw, $pTw);
                            $pMaxLen = max(strlen($pQw), strlen($pTw));
                            if ($pMaxLen > 0 && $pDist <= $allowedTypos) {
                                $pSimilarity = 1 - ($pDist / $pMaxLen);
                                $pScore = 55 * $pSimilarity;
                                $bestWordScore = max($bestWordScore, $pScore);
                            }
                        }
                    }
                }
            }

            if ($bestWordScore > 0) {
                $matchedWordsCount++;
                $totalScore += $bestWordScore;
            }
        }

        // Require a reasonable proportion of query words to match
        $requiredRatio = count($queryWords) <= 2 ? 1.0 : 0.7;
        $matchRatio = count($queryWords) > 0 ? $matchedWordsCount / count($queryWords) : 0;

        if ($matchRatio >= $requiredRatio && $matchedWordsCount > 0) {
            $avgScore = $totalScore / count($queryWords);
            // Bonus for matching ALL words
            if ($matchedWordsCount === count($queryWords)) {
                $avgScore *= 1.1;
            }
            return min($avgScore, 85); // Cap below exact match scores
        }

        return 0;
    }

    /**
     * Search a list of candidate strings using fuzzy matching.
     * Returns an array of ['text' => original, 'score' => float] sorted by score desc.
     *
     * @param string $query The search query (possibly with typos)
     * @param array $candidates List of candidate strings to match against
     * @param float $minScore Minimum score threshold (default 30)
     * @param int $limit Max results to return
     * @return array
     */
    protected function fuzzySearchCandidates(string $query, array $candidates, float $minScore = 30, int $limit = 10): array
    {
        $results = [];

        foreach ($candidates as $key => $text) {
            $score = $this->fuzzyMatch($query, $text);
            if ($score >= $minScore) {
                $results[] = [
                    'key' => $key,
                    'text' => $text,
                    'score' => $score,
                ];
            }
        }

        usort($results, fn($a, $b) => $b['score'] <=> $a['score']);

        return array_slice($results, 0, $limit);
    }

    /**
     * Find the best "Did you mean?" suggestion from a set of candidates.
     * Returns the best matching text if it's significantly different from the query, null otherwise.
     */
    protected function findDidYouMean(string $query, array $candidateNames): ?string
    {
        $normQuery = $this->normalizeForFuzzy($query);

        $best = null;
        $bestScore = 0;

        foreach ($candidateNames as $name) {
            $normName = $this->normalizeForFuzzy($name);
            // Skip if it's basically the same text
            if ($normName === $normQuery || str_contains($normName, $normQuery)) {
                return null; // Exact match exists, no suggestion needed
            }

            $score = $this->fuzzyMatch($query, $name);
            if ($score > $bestScore) {
                $bestScore = $score;
                $best = $name;
            }
        }

        // Only suggest if we found something with a decent score
        return ($best && $bestScore >= 35) ? $best : null;
    }
}

