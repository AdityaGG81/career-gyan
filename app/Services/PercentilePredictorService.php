<?php

namespace App\Services;

class PercentilePredictorService
{
    /**
     * Total candidates appearing for MHT-CET (Engineering / PCM).
     */
    public const TOTAL_MHT_CET_CANDIDATES = 410000;

    /**
     * Total candidates appearing for JEE Main.
     */
    public const TOTAL_JEE_MAIN_CANDIDATES = 1250000;

    /**
     * Calculate predicted percentile and rank for MHT-CET or JEE Main.
     */
    public static function predict(
        float $marks,
        string $exam = 'mht_cet',
        string $shift = 'moderate',
        ?array $subjectMarks = null
    ): array {
        $marks = max(0, min($exam === 'jee_main' ? 300 : 200, $marks));

        if ($exam === 'jee_main') {
            return self::predictJeeMain($marks, $shift);
        }

        return self::predictMhtCet($marks, $shift, $subjectMarks);
    }

    /**
     * MHT-CET (200 marks) normalization and percentile calculation.
     */
    protected static function predictMhtCet(float $marks, string $shift, ?array $subjectMarks = null): array
    {
        // Base percentile calculation using piecewise continuous interpolation
        $percentile = self::interpolatePercentile($marks, [
            [200, 100.00],
            [180, 99.92],
            [170, 99.75],
            [160, 99.45],
            [150, 99.05],
            [140, 98.20],
            [130, 96.90],
            [120, 95.10],
            [110, 92.60],
            [100, 89.20],
            [90,  84.30],
            [80,  77.50],
            [70,  68.80],
            [60,  57.50],
            [50,  45.00],
            [40,  30.00],
            [30,  18.00],
            [20,  8.00],
            [0,   0.50],
        ]);

        // Apply shift difficulty delta
        $shiftDelta = match (strtolower($shift)) {
            'tough' => 0.65 + ($marks > 120 ? 0.35 : 0.15),
            'easy'  => -0.65 - ($marks > 120 ? 0.35 : 0.15),
            default => 0.0,
        };

        $finalPercentile = max(0.01, min(99.9999, $percentile + $shiftDelta));
        $lowerBound = max(0.01, $finalPercentile - 0.35);
        $upperBound = min(100.00, $finalPercentile + 0.35);

        $totalCandidates = self::TOTAL_MHT_CET_CANDIDATES;
        $estRank = (int) round(((100.0 - $finalPercentile) / 100.0) * $totalCandidates) + 1;
        $rankMin = (int) max(1, round($estRank * 0.92));
        $rankMax = (int) round($estRank * 1.08);

        $tierInfo = self::getTierInfo($finalPercentile);

        return [
            'exam' => 'MHT-CET (PCM 200 Marks)',
            'marks' => round($marks, 1),
            'shift' => ucfirst($shift),
            'percentile' => round($finalPercentile, 4),
            'percentile_formatted' => number_format($finalPercentile, 2) . '%',
            'percentile_range' => number_format($lowerBound, 2) . '% - ' . number_format($upperBound, 2) . '%',
            'estimated_rank' => $estRank,
            'estimated_rank_formatted' => number_format($estRank),
            'rank_range_formatted' => number_format($rankMin) . ' - ' . number_format($rankMax),
            'total_candidates' => number_format($totalCandidates),
            'band' => $tierInfo['band'],
            'band_color' => $tierInfo['color'],
            'badge' => $tierInfo['badge'],
            'tier_title' => $tierInfo['title'],
            'description' => $tierInfo['description'],
            'top_colleges' => $tierInfo['top_colleges'],
            'top_branches' => $tierInfo['top_branches'],
            'predictor_url' => url('/tools/college-predictor?percentile=' . round($finalPercentile, 2) . '&category=GOPENS'),
        ];
    }

    /**
     * JEE Main (300 marks) normalization and percentile calculation.
     */
    protected static function predictJeeMain(float $marks, string $shift): array
    {
        $percentile = self::interpolatePercentile($marks, [
            [300, 100.00],
            [270, 99.95],
            [240, 99.80],
            [210, 99.40],
            [180, 98.80],
            [160, 98.00],
            [140, 96.50],
            [120, 94.00],
            [100, 90.00],
            [80,  83.00],
            [60,  72.00],
            [40,  55.00],
            [20,  30.00],
            [0,   1.00],
        ]);

        $shiftDelta = match (strtolower($shift)) {
            'tough' => 0.75,
            'easy'  => -0.75,
            default => 0.0,
        };

        $finalPercentile = max(0.01, min(99.9999, $percentile + $shiftDelta));
        $totalCandidates = self::TOTAL_JEE_MAIN_CANDIDATES;
        $estRank = (int) round(((100.0 - $finalPercentile) / 100.0) * $totalCandidates) + 1;
        $rankMin = (int) max(1, round($estRank * 0.90));
        $rankMax = (int) round($estRank * 1.10);

        $tierInfo = self::getTierInfo($finalPercentile);

        return [
            'exam' => 'JEE Main (300 Marks)',
            'marks' => round($marks, 1),
            'shift' => ucfirst($shift),
            'percentile' => round($finalPercentile, 4),
            'percentile_formatted' => number_format($finalPercentile, 2) . '%',
            'percentile_range' => number_format(max(0, $finalPercentile - 0.5), 2) . '% - ' . number_format(min(100, $finalPercentile + 0.5), 2) . '%',
            'estimated_rank' => $estRank,
            'estimated_rank_formatted' => number_format($estRank),
            'rank_range_formatted' => number_format($rankMin) . ' - ' . number_format($rankMax),
            'total_candidates' => number_format($totalCandidates),
            'band' => $tierInfo['band'],
            'band_color' => $tierInfo['color'],
            'badge' => $tierInfo['badge'],
            'tier_title' => $tierInfo['title'],
            'description' => $tierInfo['description'],
            'top_colleges' => $tierInfo['top_colleges'],
            'top_branches' => $tierInfo['top_branches'],
            'predictor_url' => url('/tools/college-predictor?percentile=' . round($finalPercentile, 2) . '&category=AI'),
        ];
    }

    /**
     * Piecewise linear interpolation helper.
     */
    protected static function interpolatePercentile(float $marks, array $brackets): float
    {
        for ($i = 0; $i < count($brackets) - 1; $i++) {
            $upper = $brackets[$i];
            $lower = $brackets[$i + 1];

            if ($marks <= $upper[0] && $marks >= $lower[0]) {
                $rangeMarks = $upper[0] - $lower[0];
                if ($rangeMarks == 0) return $upper[1];
                $ratio = ($marks - $lower[0]) / $rangeMarks;
                return $lower[1] + $ratio * ($upper[1] - $lower[1]);
            }
        }
        return $marks >= $brackets[0][0] ? 100.00 : 0.50;
    }

    /**
     * Get admission tier context and recommended colleges.
     */
    protected static function getTierInfo(float $percentile): array
    {
        if ($percentile >= 99.0) {
            return [
                'band' => 'Elite Tier (Top 1%)',
                'color' => '#059669',
                'badge' => 'High Probability for Top Autonomous Institutes',
                'title' => 'Top 1% Rank Holder - Tier 1 Autonomous Institutions',
                'description' => 'Outstanding score! You are eligible for premier state institutes like COEP Pune, VJTI Mumbai, SPIT Mumbai, and PICT in premium branches like Computer Engineering, AI-DS, and IT.',
                'top_colleges' => ['COEP Pune', 'VJTI Mumbai', 'SPIT Mumbai', 'PICT Pune', 'Walchand Sangli'],
                'top_branches' => ['Computer Science & Engineering', 'Artificial Intelligence & Data Science', 'Information Technology', 'Electronics & Telecomm'],
            ];
        }

        if ($percentile >= 95.0) {
            return [
                'band' => 'Tier 1 Institutions (Top 5%)',
                'color' => '#2563eb',
                'badge' => 'Very High Probability for Premium Engineering Colleges',
                'title' => 'Top 5% Rank Holder - Premier Government & Autonomous Colleges',
                'description' => 'Excellent score! You have strong chances of securing Computer Science, IT, and AI branches in leading institutes like VIT Pune, PCCOE, D.J. Sanghvi, VESIT Mumbai, and WCE Sangli.',
                'top_colleges' => ['VIT Pune', 'PCCOE Pune', 'D.J. Sanghvi Mumbai', 'VESIT Chembur', 'Thadomal Shahani Mumbai'],
                'top_branches' => ['Computer Engineering', 'Information Technology', 'AI & Machine Learning', 'Data Science', 'ENTC'],
            ];
        }

        if ($percentile >= 90.0) {
            return [
                'band' => 'Tier 2 Premium Colleges (Top 10%)',
                'color' => '#7c3aed',
                'badge' => 'Strong Admission Chances in Reputed Engineering Colleges',
                'title' => 'Top 10% Rank Holder - Reputed State Engineering Colleges',
                'description' => 'Great performance! You are eligible for Computer Science / IT / Core branches in reputed colleges like K.J. Somaiya, VIIT Pune, Cummins College, SIES GST, and MIT-WPU.',
                'top_colleges' => ['K.J. Somaiya Sion', 'VIIT Pune', 'MKSSS Cummins Pune', 'SIES GST Navi Mumbai', 'Fr. Conceicao Rodrigues Bandra'],
                'top_branches' => ['Computer Engineering', 'IT', 'Robotics & Automation', 'Electronics & Computer Engg', 'Mechanical'],
            ];
        }

        if ($percentile >= 80.0) {
            return [
                'band' => 'Established Engineering Colleges',
                'color' => '#d97706',
                'badge' => 'Good Admission Opportunities Across Maharashtra',
                'title' => 'Top 20% Rank Holder - Established Engineering Colleges',
                'description' => 'Solid score! You qualify for top branches in reputed regional colleges like D.Y. Patil Akurdi, Thakur College, Sinhgad Pune, AISSMS, and Atharva Mumbai.',
                'top_colleges' => ['D.Y. Patil Akurdi', 'Thakur College of Engg Mumbai', 'AISSMS Pune', 'Sinhgad Vadgaon Pune', 'Pillai College of Engg'],
                'top_branches' => ['Computer Engg (Second Shifts / Allied)', 'ENTC', 'Electrical Engg', 'Mechanical Engg', 'Civil Engg'],
            ];
        }

        if ($percentile >= 65.0) {
            return [
                'band' => 'Regional & Private Institutions',
                'color' => '#0891b2',
                'badge' => 'Eligible for Wide Selection of Regional Colleges',
                'title' => 'Competitive Score - Regional Engineering Institutions',
                'description' => 'You have numerous options in regional engineering colleges across Pune, Mumbai, Nagpur, Nashik, and Aurangabad for IT, Core, and Allied branches.',
                'top_colleges' => ['JSPM Tathawade Pune', 'Modern College Pune', 'Universal College Mumbai', 'Raisoni College Nagpur', 'Sandip University Nashik'],
                'top_branches' => ['Information Technology', 'Electronics & Telecomm', 'Electrical Engineering', 'Mechanical', 'Civil'],
            ];
        }

        return [
            'band' => 'Standard Admission Pool',
            'color' => '#64748b',
            'badge' => 'Eligible for CAP Rounds & Institute Level Quota',
            'title' => 'Qualified for Maharashtra Engineering CAP Rounds',
            'description' => 'You are eligible to participate in Maharashtra State CAP rounds for engineering admissions and institutional spot rounds across Maharashtra.',
            'top_colleges' => ['Regional Approved Engineering Colleges', 'Institutional Merit Quota Seats'],
            'top_branches' => ['Civil Engineering', 'Mechanical Engineering', 'Electrical Engineering', 'Chemical Engineering'],
        ];
    }
}
