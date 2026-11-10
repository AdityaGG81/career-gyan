<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'user_id',
        'display_name',
        'persona',
        'headline',
        'avatar_color',
        'target_stream',
        'target_college',
        'reputation_points',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Persona definition meta.
     */
    public static function getPersonaMeta($persona): array
    {
        $meta = [
            '10th/12th Student' => [
                'label' => 'High School Student (10th/12th)',
                'icon' => 'fa-solid fa-graduation-cap',
                'badge_class' => 'persona-badge-student',
                'color' => '#2563eb',
                'bg' => '#eff6ff',
            ],
            'College Student' => [
                'label' => 'College / University Student',
                'icon' => 'fa-solid fa-building-columns',
                'badge_class' => 'persona-badge-college',
                'color' => '#6366f1',
                'bg' => '#eef2ff',
            ],
            'Working Professional' => [
                'label' => 'Working Professional / Industry Expert',
                'icon' => 'fa-solid fa-briefcase',
                'badge_class' => 'persona-badge-professional',
                'color' => '#059669',
                'bg' => '#ecfdf5',
            ],
            'Career Counselor' => [
                'label' => 'Career Counselor / Educator',
                'icon' => 'fa-solid fa-compass',
                'badge_class' => 'persona-badge-counselor',
                'color' => '#d97706',
                'bg' => '#fffbeb',
            ],
            'Parent / Guardian' => [
                'label' => 'Parent / Guardian',
                'icon' => 'fa-solid fa-people-roof',
                'badge_class' => 'persona-badge-parent',
                'color' => '#e11d48',
                'bg' => '#fff1f2',
            ],
            'Alumnus / Mentor' => [
                'label' => 'Alumnus / Mentor',
                'icon' => 'fa-solid fa-award',
                'badge_class' => 'persona-badge-mentor',
                'color' => '#7c3aed',
                'bg' => '#f5f3ff',
            ],
        ];

        return $meta[$persona] ?? [
            'label' => $persona ?: 'Community Member',
            'icon' => 'fa-solid fa-user',
            'badge_class' => 'persona-badge-default',
            'color' => '#475569',
            'bg' => '#f1f5f9',
        ];
    }
}
