<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class StudentAnalysis extends Model
{
    use HasFactory;

    protected $table = 'student_analyses';

    protected $fillable = [
        'uuid',
        'user_id',
        'full_name',
        'mobile_number',
        'email',
        'current_class',
        'current_stream',
        'city_district',
        'exam_results_last_3_years',
        'top_subjects_last_3_years',
        'desired_admission_course',
        'enjoyed_subjects',
        'difficult_subjects',
        'completed_aptitude_test',
        'aptitude_test_scores',
        'strongest_aptitude_areas',
        'aptitude_report_file',
        'personal_interests',
        'special_hobbies_talents',
        'enjoyed_activities',
        'free_day_preference',
        'strongest_skills',
        'work_with_preference',
        'work_style',
        'personality_descriptions',
        'problem_solving_rating',
        'learning_tech_rating',
        'interested_career_fields',
        'dream_career',
        'dream_career_reason',
        'career_priorities',
        'business_startup_interest',
        'preferred_work_environments',
        'people_interaction_comfort',
        'machines_tools_comfort',
        'higher_studies_willingness',
        'study_outside_city',
        'preferred_study_location',
        'annual_education_budget',
        'need_scholarship_loan_info',
        'top_three_careers_courses',
        'parent_suggested_career',
        'parent_preference_alignment',
        'limitations_constraints',
        'dream_career_no_limitations',
        'no_limitations_reason',
        'biggest_career_confusion',
        'help_requested',
        'additional_info',
    ];

    protected $casts = [
        'enjoyed_subjects' => 'array',
        'difficult_subjects' => 'array',
        'strongest_aptitude_areas' => 'array',
        'enjoyed_activities' => 'array',
        'strongest_skills' => 'array',
        'personality_descriptions' => 'array',
        'interested_career_fields' => 'array',
        'career_priorities' => 'array',
        'preferred_work_environments' => 'array',
        'help_requested' => 'array',
        'problem_solving_rating' => 'integer',
        'learning_tech_rating' => 'integer',
        'people_interaction_comfort' => 'integer',
        'machines_tools_comfort' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
