<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestMailSend extends Command
{
    protected $signature = 'mail:test {email? : Email address to send to}';
    protected $description = 'Test sending an OTP email';

    public function handle()
    {
        $to = $this->argument('email') ?? config('mail.from.address');

        $this->info("Testing mail to: {$to}");
        $this->info("MAIL_HOST: " . config('mail.mailers.smtp.host'));
        $this->info("MAIL_PORT: " . config('mail.mailers.smtp.port'));
        $this->info("MAIL_USERNAME: " . config('mail.mailers.smtp.username'));
        $this->info("MAIL_ENCRYPTION: " . config('mail.mailers.smtp.encryption'));

        try {
            $otp = random_int(100000, 999999);
            Mail::raw(
                "Your CareerGyan email verification code is: {$otp}",
                function ($message) use ($to) {
                    $message->to($to)->subject('Verify Your Email - Test');
                }
            );
            $this->info("✅ Email sent successfully to {$to}!");
            return 0;
        } catch (\Exception $e) {
            $this->error("❌ Mail Error: " . $e->getMessage());
            $this->error("Class: " . get_class($e));
            return 1;
        }
    }
}
