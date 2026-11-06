<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuickTestAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'student_name',
        'student_email',
        'answers',
        'section_scores',
        'total_score',
        'recommended_careers',
    ];

    protected $casts = [
        'answers' => 'array',
        'section_scores' => 'array',
        'recommended_careers' => 'array',
    ];

    /**
     * Get top stream names as an array of strings
     */
    public function getTopStreamNamesAttribute(): array
    {
        $careers = $this->recommended_careers;
        if (empty($careers) || !is_array($careers)) {
            return [];
        }

        $names = [];
        foreach ($careers as $item) {
            if (is_array($item) && isset($item['section'])) {
                $names[] = $item['section'];
            } elseif (is_string($item)) {
                $names[] = $item;
            }
        }
        return $names;
    }

    /**
     * Get formatted stream summary string
     */
    public function getStreamSummaryAttribute(): string
    {
        $careers = $this->recommended_careers;
        if (empty($careers)) {
            return 'General Vocational Stream';
        }

        if (is_string($careers)) {
            return $careers;
        }

        $streams = [];
        if (is_array($careers)) {
            foreach ($careers as $item) {
                if (is_array($item) && isset($item['section'])) {
                    $areas = !empty($item['areas']) && is_array($item['areas']) 
                        ? ' (' . implode(', ', array_slice($item['areas'], 0, 2)) . ')'
                        : '';
                    $streams[] = $item['section'] . $areas;
                } elseif (is_string($item)) {
                    $streams[] = $item;
                }
            }
        }

        return !empty($streams) ? implode('; ', $streams) : 'Career Aptitude Stream';
    }
}
