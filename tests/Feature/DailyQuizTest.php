<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\DailyQuizQuestion;
use App\Models\DailyQuizAttempt;
use App\Models\UserQuizStat;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DailyQuizTest extends TestCase
{
    use RefreshDatabase;

    private function createQuizQuestion($offset = 0, $active = true)
    {
        return DailyQuizQuestion::create([
            'quiz_date' => today()->addDays($offset)->toDateString(),
            'question_text' => 'What is the primary Agile facilitator role?',
            'option_a' => 'Developer',
            'option_b' => 'Product Owner',
            'option_c' => 'Scrum Master',
            'option_d' => 'Tester',
            'correct_option' => 'c',
            'explanation' => 'Scrum Master facilitates the process.',
            'category' => 'technology',
            'difficulty' => 'medium',
            'points' => 10,
            'is_active' => $active,
        ]);
    }

    public function test_guest_is_redirected_from_taking_quiz()
    {
        $response = $this->get(route('daily-quiz.take'));
        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_view_index()
    {
        $user = User::factory()->create();
        $question = $this->createQuizQuestion();

        $response = $this->actingAs($user)->get(route('daily-quiz.index'));
        $response->assertStatus(200);
        $response->assertSee('Question hidden');
    }

    public function test_user_can_submit_correct_answer_and_gain_points()
    {
        $user = User::factory()->create();
        $question = $this->createQuizQuestion();

        $response = $this->actingAs($user)->post(route('daily-quiz.submit'), [
            'question_id' => $question->id,
            'selected_option' => 'c',
            'time_taken_seconds' => 5, // Under 10s for speed bonus
        ]);

        $attempt = DailyQuizAttempt::where('user_id', $user->id)->first();
        $response->assertRedirect(route('daily-quiz.result', ['date' => today()->toDateString(), 'attempt_id' => $attempt->id]));

        // Verify attempt was saved
        $this->assertDatabaseHas('daily_quiz_attempts', [
            'user_id' => $user->id,
            'question_id' => $question->id,
            'selected_option' => 'c',
            'is_correct' => true,
            'points_earned' => 15, // 10 base + 5 speed bonus
        ]);

        // Verify stats were updated
        $this->assertDatabaseHas('user_quiz_stats', [
            'user_id' => $user->id,
            'total_points' => 15,
            'current_streak' => 1,
            'quizzes_taken' => 1,
            'correct_answers' => 1,
            'speed_bonuses' => 1,
        ]);
    }

    public function test_user_cannot_double_submit_same_day()
    {
        $user = User::factory()->create();
        $question = $this->createQuizQuestion();

        // Submit first time
        $this->actingAs($user)->post(route('daily-quiz.submit'), [
            'question_id' => $question->id,
            'selected_option' => 'c',
            'time_taken_seconds' => 12,
        ]);

        // Attempt second submit
        $response = $this->actingAs($user)->post(route('daily-quiz.submit'), [
            'question_id' => $question->id,
            'selected_option' => 'a',
            'time_taken_seconds' => 5,
        ]);

        $attempt = DailyQuizAttempt::where('user_id', $user->id)->first();
        $response->assertRedirect(route('daily-quiz.result', ['date' => today()->toDateString(), 'attempt_id' => $attempt->id]));

        // Verify only 1 attempt exists
        $this->assertEquals(1, DailyQuizAttempt::where('user_id', $user->id)->count());
    }

    public function test_user_can_view_leaderboard()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('daily-quiz.leaderboard'));
        $response->assertStatus(200);
    }

    public function test_user_can_view_my_stats()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('daily-quiz.my-stats'));
        $response->assertStatus(200);
    }
}
