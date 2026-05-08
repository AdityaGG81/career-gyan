<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuickTestQuestion;

class QuickTestQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            // 1. Language Aptitude (2 questions)
            [
                'section' => 'Language Aptitude',
                'question_text' => 'To keep one’s temper.',
                'question_image' => null,
                'option_a' => 'To stop talking',
                'option_b' => 'To hold one’s anger',
                'option_c' => 'To be aloof',
                'option_d' => 'To become angry',
                'correct_option' => 'B',
                'marks' => 1,
            ],
            [
                'section' => 'Language Aptitude',
                'question_text' => 'Add insult to injury.',
                'question_image' => null,
                'option_a' => 'To worsen a negative situation',
                'option_b' => 'To insult a physically injured person',
                'option_c' => 'To laugh at someone',
                'option_d' => 'To taunt someone',
                'correct_option' => 'A',
                'marks' => 1,
            ],

            // 2. Abstract Reasoning (2 questions)
            [
                'section' => 'Abstract Reasoning',
                'question_text' => 'Choose the correct option based on the given diagram.',
                'question_image' => 'images/aptitude/abstract/q1_1.png',
                'option_a' => null,
                'option_b' => null,
                'option_c' => null,
                'option_d' => null,
                'option_a_image' => 'images/aptitude/abstract/q1_A.png',
                'option_b_image' => 'images/aptitude/abstract/q1_B.png',
                'option_c_image' => 'images/aptitude/abstract/q1_C.png',
                'option_d_image' => 'images/aptitude/abstract/q1_D.png',
                'correct_option' => 'A',
                'marks' => 1,
            ],
            [
                'section' => 'Abstract Reasoning',
                'question_text' => 'Choose the correct option based on the given diagram.',
                'question_image' => 'images/aptitude/abstract/q2_1.png',
                'option_a' => null,
                'option_b' => null,
                'option_c' => null,
                'option_d' => null,
                'option_a_image' => 'images/aptitude/abstract/q2_A.png',
                'option_b_image' => 'images/aptitude/abstract/q2_B.png',
                'option_c_image' => 'images/aptitude/abstract/q2_C.png',
                'option_d_image' => 'images/aptitude/abstract/q2_D.png',
                'correct_option' => 'B',
                'marks' => 1,
            ],

            // 3. Verbal Reasoning (2 questions)
            [
                'section' => 'Verbal Reasoning',
                'question_text' => '________ is to Thick as Silence is to ________',
                'question_image' => null,
                'option_a' => 'Bold — Loud',
                'option_b' => 'Bold — Noise',
                'option_c' => 'Thin — Noise',
                'option_d' => 'Thin — Loud',
                'correct_option' => 'C',
                'marks' => 1,
            ],
            [
                'section' => 'Verbal Reasoning',
                'question_text' => '________ is to Porous as Rubber is to ________',
                'question_image' => null,
                'option_a' => 'Glass — Elastic',
                'option_b' => 'Sponge — Elastic',
                'option_c' => 'Sponge — Solid',
                'option_d' => 'Glass — Solid',
                'correct_option' => 'B',
                'marks' => 1,
            ],

            // 4. Mechanical Reasoning (2 questions)
            [
                'section' => 'Mechanical Reasoning',
                'question_text' => 'Which direction will the gear turn?',
                'question_image' => 'images/aptitude/mechanical/q1.png',
                'option_a' => 'Clockwise',
                'option_b' => 'Counter-Clockwise',
                'option_c' => 'Will not turn',
                'option_d' => 'Both directions',
                'correct_option' => 'C',
                'marks' => 1,
            ],
            [
                'section' => 'Mechanical Reasoning',
                'question_text' => 'Which weight is heavier based on the pulley system?',
                'question_image' => 'images/aptitude/mechanical/q2.png',
                'option_a' => 'Weight A',
                'option_b' => 'Weight B',
                'option_c' => 'Both are equal',
                'option_d' => 'None of the above',
                'correct_option' => 'D',
                'marks' => 1,
            ],

            // 5. Numerical Aptitude (2 questions)
            [
                'section' => 'Numerical Aptitude',
                'question_text' => 'What is the next number in the sequence? 2400, 1200, 600, 300, ?',
                'question_image' => null,
                'option_a' => '0',
                'option_b' => '100',
                'option_c' => '150',
                'option_d' => '200',
                'correct_option' => 'C',
                'marks' => 1,
            ],
            [
                'section' => 'Numerical Aptitude',
                'question_text' => '38 = 19% of (?)',
                'question_image' => null,
                'option_a' => '20',
                'option_b' => '200',
                'option_c' => '300',
                'option_d' => '2000',
                'correct_option' => 'B',
                'marks' => 1,
            ],

            // 6. Spatial Aptitude (2 questions)
            [
                'section' => 'Spatial Aptitude',
                'question_text' => 'Choose the correct option based on the given diagram.',
                'question_image' => 'images/aptitude/spatial/q1_problem.png',
                'option_a' => null,
                'option_b' => null,
                'option_c' => null,
                'option_d' => null,
                'option_a_image' => 'images/aptitude/spatial/q1_A.png',
                'option_b_image' => 'images/aptitude/spatial/q1_B.png',
                'option_c_image' => 'images/aptitude/spatial/q1_C.png',
                'option_d_image' => 'images/aptitude/spatial/q1_D.png',
                'correct_option' => 'A',
                'marks' => 1,
            ],
            [
                'section' => 'Spatial Aptitude',
                'question_text' => 'Choose the correct option based on the given diagram.',
                'question_image' => 'images/aptitude/spatial/q2_problem.png',
                'option_a' => null,
                'option_b' => null,
                'option_c' => null,
                'option_d' => null,
                'option_a_image' => 'images/aptitude/spatial/q2_A.png',
                'option_b_image' => 'images/aptitude/spatial/q2_B.png',
                'option_c_image' => 'images/aptitude/spatial/q2_C.png',
                'option_d_image' => 'images/aptitude/spatial/q2_D.png',
                'correct_option' => 'B',
                'marks' => 1,
            ],

            // 7. Perceptual Aptitude (4 questions)
            [
                'section' => 'Perceptual Aptitude',
                'question_text' => 'Choose the correct option based on the given diagram.',
                'question_image' => 'images/aptitude/abstract/q3_1.png',
                'option_a' => null,
                'option_b' => null,
                'option_c' => null,
                'option_d' => null,
                'option_a_image' => 'images/aptitude/abstract/q3_A.png',
                'option_b_image' => 'images/aptitude/abstract/q3_B.png',
                'option_c_image' => 'images/aptitude/abstract/q3_C.png',
                'option_d_image' => 'images/aptitude/abstract/q3_D.png',
                'correct_option' => 'A',
                'marks' => 1,
            ],
            [
                'section' => 'Perceptual Aptitude',
                'question_text' => 'Choose the correct option based on the given diagram.',
                'question_image' => 'images/aptitude/abstract/q4_1.png',
                'option_a' => null,
                'option_b' => null,
                'option_c' => null,
                'option_d' => null,
                'option_a_image' => 'images/aptitude/abstract/q4_A.png',
                'option_b_image' => 'images/aptitude/abstract/q4_B.png',
                'option_c_image' => 'images/aptitude/abstract/q4_C.png',
                'option_d_image' => 'images/aptitude/abstract/q4_D.png',
                'correct_option' => 'B',
                'marks' => 1,
            ],
            [
                'section' => 'Perceptual Aptitude',
                'question_text' => 'Choose the correct option based on the given diagram.',
                'question_image' => 'images/aptitude/abstract/q5_1.png',
                'option_a' => null,
                'option_b' => null,
                'option_c' => null,
                'option_d' => null,
                'option_a_image' => 'images/aptitude/abstract/q5_A.png',
                'option_b_image' => 'images/aptitude/abstract/q5_B.png',
                'option_c_image' => 'images/aptitude/abstract/q5_C.png',
                'option_d_image' => 'images/aptitude/abstract/q5_D.png',
                'correct_option' => 'C',
                'marks' => 1,
            ],
            [
                'section' => 'Perceptual Aptitude',
                'question_text' => 'Choose the correct option based on the given diagram.',
                'question_image' => 'images/aptitude/abstract/q1_2.png',
                'option_a' => null,
                'option_b' => null,
                'option_c' => null,
                'option_d' => null,
                'option_a_image' => 'images/aptitude/abstract/q1_A.png',
                'option_b_image' => 'images/aptitude/abstract/q1_B.png',
                'option_c_image' => 'images/aptitude/abstract/q1_C.png',
                'option_d_image' => 'images/aptitude/abstract/q1_D.png',
                'correct_option' => 'D',
                'marks' => 1,
            ],
        ];

        QuickTestQuestion::truncate();

        foreach ($questions as $q) {
            QuickTestQuestion::create($q);
        }
    }
}
