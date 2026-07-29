<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipPlan extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'duration_days',
        'features',
        'is_active'
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean'
    ];

    public function memberships()
    {
        return $this->hasMany(Membership::class, 'plan_id');
    }
}
