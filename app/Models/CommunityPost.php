<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CommunityPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'author_name',
        'author_persona',
        'author_headline',
        'author_badge',
        'channel',
        'title',
        'slug',
        'content',
        'tags',
        'upvotes_count',
        'answers_count',
        'views_count',
        'is_pinned',
        'is_resolved',
        'guest_session_id',
        'ip_address',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_pinned' => 'boolean',
        'is_resolved' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(CommunityAnswer::class, 'post_id')->orderBy('upvotes_count', 'desc')->orderBy('created_at', 'asc');
    }

    public function votes()
    {
        return $this->hasMany(CommunityVote::class, 'votable_id')->where('votable_type', 'post');
    }

    /**
     * Channels metadata.
     */
    public static function getChannels(): array
    {
        return [
            'all' => [
                'name' => 'All Discussions',
                'slug' => 'all',
                'prefix' => 'c/all',
                'icon' => 'fa-solid fa-layer-group',
                'color' => '#0f172a',
                'bg' => '#f1f5f9',
                'desc' => 'Every question, advice, and discussion across CareerGyan',
            ],
            'career-advice' => [
                'name' => 'Career Advice',
                'slug' => 'career-advice',
                'prefix' => 'c/CareerAdvice',
                'icon' => 'fa-solid fa-compass',
                'color' => '#2563eb',
                'bg' => '#eff6ff',
                'desc' => 'Ask career path, scope, salaries, and transition questions',
            ],
            'college-admissions' => [
                'name' => 'College Admissions',
                'slug' => 'college-admissions',
                'prefix' => 'c/CollegeAdmissions',
                'icon' => 'fa-solid fa-building-columns',
                'color' => '#059669',
                'bg' => '#ecfdf5',
                'desc' => 'MHT CET cutoffs, CAP rounds, JEE/NEET counseling, college reviews',
            ],
            'engineering' => [
                'name' => 'Engineering & Tech',
                'slug' => 'engineering',
                'prefix' => 'c/Engineering',
                'icon' => 'fa-solid fa-microchip',
                'color' => '#7c3aed',
                'bg' => '#f5f3ff',
                'desc' => 'Computer Science, AI, Mechanical, Electrical & IT branches',
            ],
            'medical-ayush' => [
                'name' => 'Medical & AYUSH',
                'slug' => 'medical-ayush',
                'prefix' => 'c/MedicalAYUSH',
                'icon' => 'fa-solid fa-stethoscope',
                'color' => '#0284c7',
                'bg' => '#f0f9ff',
                'desc' => 'MBBS, BDS, BAMS, BHMS, Pharmacy & Allied Healthcare',
            ],
            'business-startups' => [
                'name' => 'Business & Startups',
                'slug' => 'business-startups',
                'prefix' => 'c/BusinessStartups',
                'icon' => 'fa-solid fa-briefcase',
                'color' => '#d97706',
                'bg' => '#fffbeb',
                'desc' => 'BBA/MBA, commerce, entrepreneurial ventures, and small businesses',
            ],
            'exams-prep' => [
                'name' => 'Exams & Prep',
                'slug' => 'exams-prep',
                'prefix' => 'c/ExamsPrep',
                'icon' => 'fa-solid fa-book-open',
                'color' => '#dc2626',
                'bg' => '#fef2f2',
                'desc' => 'Study strategies, books, mock tests, and syllabus queries',
            ],
            'arts-creative' => [
                'name' => 'Arts, Design & Media',
                'slug' => 'arts-creative',
                'prefix' => 'c/ArtsCreative',
                'icon' => 'fa-solid fa-palette',
                'color' => '#db2777',
                'bg' => '#fdf2f8',
                'desc' => 'UI/UX design, animation, fine arts, filmmaking, sports & creative fields',
            ],
            'general' => [
                'name' => 'Student Life & Chit-Chat',
                'slug' => 'general',
                'prefix' => 'c/General',
                'icon' => 'fa-solid fa-comments',
                'color' => '#475569',
                'bg' => '#f8fafc',
                'desc' => 'Hostel life, mental health, study routines, and peer support',
            ],
        ];
    }

    public function getChannelMetaAttribute(): array
    {
        $channels = self::getChannels();
        return $channels[$this->channel] ?? [
            'name' => ucfirst(str_replace('-', ' ', $this->channel)),
            'slug' => $this->channel,
            'prefix' => 'c/' . Str::studly($this->channel),
            'icon' => 'fa-solid fa-comments',
            'color' => '#2563eb',
            'bg' => '#eff6ff',
            'desc' => 'Community Discussion',
        ];
    }
}

