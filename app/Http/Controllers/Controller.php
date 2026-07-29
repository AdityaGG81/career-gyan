<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /**
     * Perform fuzzy matching between a query and a target text.
     * Returns a score between 0 and 100 if there's a match, or 0 if no match.
     */
    protected function fuzzyMatch(string $query, string $text): float
    {
        $query = strtolower(trim($query));
        $text = strtolower(trim($text));
        
        if (empty($query)) {
            return 0;
        }
        
        // Exact substring matches
        if (str_contains($text, $query)) {
            return str_starts_with($text, $query) ? 100 : 90;
        }
        
        $queryWords = preg_split('/\s+/', $query);
        $textWords = preg_split('/\s+/', $text);
        
        $matchedWordsCount = 0;
        $totalScore = 0;
        
        foreach ($queryWords as $qw) {
            $bestWordScore = 0;
            foreach ($textWords as $tw) {
                // Prefix match
                if (str_starts_with($tw, $qw)) {
                    $wordScore = 80 * (strlen($qw) / strlen($tw));
                    if ($wordScore > $bestWordScore) {
                        $bestWordScore = $wordScore;
                    }
                }
                // Substring match
                elseif (str_contains($tw, $qw)) {
                    $wordScore = 70 * (strlen($qw) / strlen($tw));
                    if ($wordScore > $bestWordScore) {
                        $bestWordScore = $wordScore;
                    }
                }
                // Typo-tolerant Levenshtein match
                else {
                    $lenQw = strlen($qw);
                    $lenTw = strlen($tw);
                    $maxLen = max($lenQw, $lenTw);
                    if ($maxLen > 0 && $maxLen < 255) {
                        $dist = levenshtein($qw, $tw);
                        // Allowed typos: 1 typo for 3-5 chars, 2 typos for 6+ chars
                        $allowedTypos = $lenQw <= 5 ? 1 : 2;
                        if ($lenQw < 3) {
                            $allowedTypos = 0;
                        }
                        
                        if ($dist <= $allowedTypos) {
                            $similarity = 1 - ($dist / $maxLen);
                            $wordScore = 60 * $similarity;
                            if ($wordScore > $bestWordScore) {
                                $bestWordScore = $wordScore;
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
        
        // All query words must match to some degree
        if ($matchedWordsCount === count($queryWords)) {
            return $totalScore / count($queryWords);
        }
        
        return 0;
    }
}

