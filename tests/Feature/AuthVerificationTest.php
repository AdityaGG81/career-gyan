<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AuthVerificationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Mail::fake();
    }

    public function test_user_can_verify_email_with_correct_otp()
    {
        $user = User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'password' => bcrypt('password123'),
            'email_otp' => '123456',
            'email_otp_expires_at' => now()->addMinutes(10),
        ]);

        $response = $this->withSession(['verification_user_id' => $user->id])
            ->post('/verify-email', [
                'otp' => '123456',
            ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('success');

        $user->refresh();
        $this->assertNotNull($user->email_verified_at);
        $this->assertNull($user->email_otp);
        $this->assertNull($user->email_otp_expires_at);
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_verify_email_with_incorrect_otp()
    {
        $user = User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'password' => bcrypt('password123'),
            'email_otp' => '123456',
            'email_otp_expires_at' => now()->addMinutes(10),
        ]);

        $response = $this->withSession(['verification_user_id' => $user->id])
            ->from('/verify-email')
            ->post('/verify-email', [
                'otp' => '654321',
            ]);

        $response->assertRedirect('/verify-email');
        $response->assertSessionHas('error', 'Invalid verification code.');

        $user->refresh();
        $this->assertNull($user->email_verified_at);
        $this->assertNotNull($user->email_otp);
    }

    public function test_user_cannot_verify_email_with_expired_otp()
    {
        $user = User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'password' => bcrypt('password123'),
            'email_otp' => '123456',
            'email_otp_expires_at' => now()->subMinutes(1),
        ]);

        $response = $this->withSession(['verification_user_id' => $user->id])
            ->from('/verify-email')
            ->post('/verify-email', [
                'otp' => '123456',
            ]);

        $response->assertRedirect('/verify-email');
        $response->assertSessionHas('error', 'Verification code has expired. Please request a new OTP.');

        $user->refresh();
        $this->assertNull($user->email_verified_at);
    }

    public function test_user_can_resend_otp_after_cooldown()
    {
        $user = User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'password' => bcrypt('password123'),
            'email_otp' => '123456',
            'email_otp_expires_at' => now()->addMinutes(10),
            'last_otp_sent_at' => now()->subSeconds(61),
        ]);

        $response = $this->withSession(['verification_user_id' => $user->id])
            ->from('/verify-email')
            ->post('/resend-email-otp');

        $response->assertRedirect('/verify-email');
        $response->assertSessionHas('success', 'OTP sent successfully.');

        $user->refresh();
        $this->assertNotEquals('123456', $user->email_otp);
        $this->assertNotNull($user->email_otp);
        $this->assertNotNull($user->email_otp_expires_at);
    }

    public function test_user_cannot_resend_otp_during_cooldown()
    {
        $user = User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'password' => bcrypt('password123'),
            'email_otp' => '123456',
            'email_otp_expires_at' => now()->addMinutes(10),
            'last_otp_sent_at' => now()->subSeconds(30),
        ]);

        $response = $this->withSession(['verification_user_id' => $user->id])
            ->from('/verify-email')
            ->post('/resend-email-otp');

        $response->assertRedirect('/verify-email');
        $response->assertSessionHas('error', function ($value) {
            return str_contains($value, 'Wait') && str_contains($value, 'seconds before resending OTP');
        });

        $user->refresh();
        $this->assertEquals('123456', $user->email_otp);
    }
}
