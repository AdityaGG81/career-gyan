<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessIdea extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'field_id',
        'category',
        'description',
        'investment',
        'initial_investment',
        'profit_margin',
        'risk_level',
        'start_time',
        'skills_required',
        'soft_skills',
        'opportunities',
        'break_even_period',
        'target_audience',
        'equipment_needed',
        'icon',
        'status',
    ];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    /**
     * Standard categories list
     */
    public static function getStandardCategories(): array
    {
        return [
            'Retail',
            'Wholesale',
            'IT & Software',
            'Electronics',
            'Food & Hospitality',
            'Manufacturing & Production',
            'Healthcare & Wellness',
            'Education & Services',
            'Agriculture & Allied',
            'Creative & Digital',
        ];
    }

    /**
     * Get effective investment amount string
     */
    public function getEffectiveInvestmentAttribute(): string
    {
        return $this->initial_investment ?: ($this->investment ?: '₹50,000 - ₹2,00,000');
    }

    /**
     * Convert skills_required into clean array
     */
    public function getSkillsListAttribute(): array
    {
        if (empty($this->skills_required)) {
            return [];
        }

        return $this->splitStringToArray($this->skills_required);
    }

    /**
     * Convert soft_skills into clean array
     */
    public function getSoftSkillsListAttribute(): array
    {
        if (empty($this->soft_skills)) {
            return [];
        }

        return $this->splitStringToArray($this->soft_skills);
    }

    /**
     * Convert opportunities into clean array
     */
    public function getOpportunitiesListAttribute(): array
    {
        if (empty($this->opportunities)) {
            return [];
        }

        return $this->splitStringToArray($this->opportunities);
    }

    /**
     * Helper to parse comma, pipe, or newline delimited strings
     */
    private function splitStringToArray(string $str): array
    {
        $raw = preg_split('/[\r\n,•|]+/', $str);
        $clean = [];
        foreach ($raw as $item) {
            $t = trim($item, " \t\n\r\0\x0B-•*");
            if (!empty($t)) {
                $clean[] = $t;
            }
        }
        return $clean;
    }
}
