<?php

namespace Tests\Feature;

use App\Models\SpecializedAptitudeQuestion;
use App\Models\SpecializedTestAttempt;
use App\Http\Controllers\SpecializedAptitudeController;
use Tests\TestCase;

class SportsAptitudeTest extends TestCase
{
    /**
     * Test sports landing page renders with sport list.
     */
    public function test_sports_landing_page_renders_with_sports_list(): void
    {
        $response = $this->get(route('specialized-aptitude.show', 'sports'));
        $response->assertStatus(200);
        $response->assertSee('Choose Your Sport Specialization');
        $response->assertSee('Cricket');
        $response->assertSee('Football (Soccer)');
        $response->assertSee('Badminton');
    }

    /**
     * Test navigating to sports test without sport parameter shows sport selection step.
     */
    public function test_sports_quiz_without_sport_shows_selection_step(): void
    {
        $response = $this->get(route('specialized-aptitude.quiz', 'sports'));
        $response->assertStatus(200);
        $response->assertSee('Step 1: Choose Your Sport Specialization');
        $response->assertViewHas('needsSportSelection', true);
    }

    /**
     * Test navigating to sports test with cricket loads 20 questions (10 general + 10 cricket).
     */
    public function test_sports_quiz_with_chosen_sport_loads_twenty_questions(): void
    {
        $response = $this->get(route('specialized-aptitude.quiz', ['category' => 'sports', 'sport' => 'cricket']));
        $response->assertStatus(200);
        $response->assertViewHas('needsSportSelection', false);
        $response->assertViewHas('sport', 'cricket');

        $questions = $response->viewData('questions');
        $this->assertCount(20, $questions);

        // First 10 questions are general
        for ($i = 0; $i < 10; $i++) {
            $this->assertTrue(
                $questions[$i]->sport === 'general' || is_null($questions[$i]->sport),
                "Question at index {$i} should be general"
            );
        }

        // Remaining 10 questions are for cricket
        for ($i = 10; $i < 20; $i++) {
            $this->assertEquals(
                'cricket',
                $questions[$i]->sport,
                "Question at index {$i} should be cricket-specific"
            );
        }
    }

    /**
     * Test submitting a test with chosen sport saves sport and generates valid results scorecard.
     */
    public function test_submit_sports_quiz_saves_sport_and_redirects(): void
    {
        $generalQ = SpecializedAptitudeQuestion::where('category', 'sports')
            ->where(function ($q) {
                $q->where('sport', 'general')->orWhereNull('sport');
            })
            ->first();

        $cricketQ = SpecializedAptitudeQuestion::where('category', 'sports')
            ->where('sport', 'cricket')
            ->first();

        $payload = [
            'sport' => 'cricket',
            'student_name' => 'Test Athlete',
            'student_email' => 'athlete@careergyan.in',
            'student_phone' => '9876543210',
            'answers' => [
                $generalQ->id => $generalQ->correct_option,
                $cricketQ->id => $cricketQ->correct_option,
            ],
        ];

        $response = $this->postJson(route('specialized-aptitude.submit', 'sports'), $payload);
        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $attempt = SpecializedTestAttempt::where('student_email', 'athlete@careergyan.in')->latest()->first();
        $this->assertNotNull($attempt);
        $this->assertEquals('sports', $attempt->category);
        $this->assertEquals('cricket', $attempt->sport);
        $this->assertEquals('Cricket', $attempt->sport_name);
        $this->assertEquals(2, $attempt->correct_answers);

        // Verify results page loads cleanly
        $resultsResponse = $this->get(route('specialized-aptitude.results', $attempt->uuid));
        $resultsResponse->assertStatus(200);
        $resultsResponse->assertSee('Cricket Specialization');
        $resultsResponse->assertSee('Section 1: General Foundations');
        $resultsResponse->assertSee('Section 2: Cricket Specialization');
    }
}
