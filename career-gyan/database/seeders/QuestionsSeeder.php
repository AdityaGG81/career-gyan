<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dimension;
use App\Models\Question;
use Illuminate\Support\Str;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dimensions = [
            'language-aptitude' => 'Language Aptitude',
            'abstract-reasoning' => 'Abstract Reasoning',
            'verbal-reasoning' => 'Verbal Reasoning',
            'mechanical-reasoning' => 'Mechanical Reasoning',
            'numerical-aptitude' => 'Numerical Aptitude',
            'spatial-aptitude' => 'Spatial Aptitude',
            'perceptual-aptitude' => 'Perceptual Aptitude',
        ];

        $dimensionMap = [];
        foreach ($dimensions as $slug => $name) {
            $dimension = Dimension::firstOrCreate(
                ['slug' => $slug],
                ['name' => $name, 'description' => 'Measures ' . $name]
            );
            $dimensionMap[$slug] = $dimension->id;
        }

        $jsonPath = database_path('data/questions.json');
        if (!file_exists($jsonPath)) {
            $this->command->error('Run the python script to generate questions.json first!');
            return;
        }

        $questionsData = json_decode(file_get_contents($jsonPath), true);
        
        // Truncate to start fresh on this seeder just in case
        Question::truncate();

        foreach ($questionsData as $q) {
            $dimensionSlug = $q['dimension_slug'] ?? 'language-aptitude';
            
            $questionImages = null;
            if (isset($q['question_images'])) {
                $questionImages = $q['question_images'];
            } elseif (isset($q['question_image']) && $q['question_image']) {
                $questionImages = [$q['question_image']];
            }

            $questionType = $q['question_type'] ?? 'text_only';
            if (empty($q['question_type'])) {
                if (isset($q['question_image']) && empty($q['question'])) {
                    $questionType = 'single_image';
                } elseif (isset($q['question_images']) && count($q['question_images']) > 1) {
                    $questionType = 'image_sequence';
                }
            }

            Question::create([
                'dimension_id' => $dimensionMap[$dimensionSlug],
                'question_type' => $questionType,
                'question_text' => $q['question'] ?? null,
                'question_images' => $questionImages,
                'options_type' => $q['options_type'] ?? 'text',
                'options' => $q['options'] ?? [],
                'correct_answer' => $q['correct_answer'] ?? '',
            ]);
        }
        
        $this->command->info(count($questionsData) . ' questions seeded successfully!');
    }
}
