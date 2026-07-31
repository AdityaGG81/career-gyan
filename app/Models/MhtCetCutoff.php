<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MhtCetCutoff extends Model
{
    use HasFactory;

    protected $fillable = [
        'college_code',
        'college_name',
        'branch_code',
        'branch_name',
        'category',
        'category_full',
        'percentile',
        'year',
        'round',
        'status',
        'quota',
        'merit_no',
        'percentile_band',
    ];

    protected $casts = [
        'college_code' => 'integer',
        'percentile' => 'decimal:7',
        'year' => 'integer',
        'merit_no' => 'integer',
    ];

    public function scopeForCollege($query, $name)
    {
        return $query->where('college_name', 'like', "%{$name}%");
    }

    public function scopeForBranch($query, $branch)
    {
        return $query->where('branch_name', 'like', "%{$branch}%");
    }

    public function scopeForCategory($query, $cat)
    {
        return $query->where('category', $cat);
    }

    public function scopeForRound($query, $round)
    {
        return $query->where('round', $round);
    }

    public function scopeForQuota($query, $quota)
    {
        return $query->where('quota', $quota);
    }

    public function getFormattedPercentileAttribute()
    {
        if ($this->percentile == 0) {
            return 'N/A';
        }

        return number_format($this->percentile, 2);
    }
}
