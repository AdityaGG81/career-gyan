<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipPlan extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'symbol',
        'badge_text',
        'description',
        'price',
        'currency_symbol',
        'original_price',
        'duration_days',
        'billing_period',
        'color_theme',
        'features',
        'is_active'
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
        'price' => 'integer',
        'original_price' => 'integer',
        'duration_days' => 'integer',
    ];

    public function memberships()
    {
        return $this->hasMany(Membership::class, 'plan_id');
    }

    public function getPriceInRupeesAttribute()
    {
        return $this->price ? ($this->price / 100) : 0;
    }

    public function getOriginalPriceInRupeesAttribute()
    {
        return $this->original_price ? ($this->original_price / 100) : null;
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->original_price && $this->original_price > $this->price) {
            return round((($this->original_price - $this->price) / $this->original_price) * 100);
        }
        return 0;
    }

    public static function getDefaultPlan()
    {
        $plan = static::where('slug', 'pro-member')->first();
        if (!$plan) {
            $plan = static::create([
                'name' => 'Pro Membership',
                'slug' => 'pro-member',
                'symbol' => 'fa-solid fa-crown',
                'badge_text' => 'MOST POPULAR',
                'description' => 'Unlock premium tools, advanced tests, 1-on-1 counseling, and expert WhatsApp group access.',
                'price' => 99900,
                'currency_symbol' => '₹',
                'original_price' => 199900,
                'duration_days' => 365,
                'billing_period' => 'yr',
                'color_theme' => 'amber',
                'features' => [
                    'Advanced Personality Profiler Test',
                    'Career Deep-Dive Roadmaps & Insights',
                    'Leadership & Entrepreneurship Assessment',
                    'Unlimited AI Chatbot Career Counseling',
                    'Private Mentor WhatsApp Group Access',
                    '1-on-1 Direct Career Session Booking',
                    'Premium PDF Downloadable Reports',
                    'Gold Pro Badge on Leaderboards'
                ],
                'is_active' => true
            ]);
        }
        return $plan;
    }
}
