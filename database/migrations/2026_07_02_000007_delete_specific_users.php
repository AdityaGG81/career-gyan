<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Delete Dyaneshwar Kakad user data from DB
        $dyaneshwarUsers = User::where('name', 'like', '%Dyaneshwar%')->get();
        foreach ($dyaneshwarUsers as $u) {
            DB::table('user_quiz_stats')->where('user_id', $u->id)->delete();
            DB::table('daily_quiz_attempts')->where('user_id', $u->id)->delete();
            DB::table('test_sessions')->where('user_id', $u->id)->delete();
            $u->delete();
        }

        // Delete Vedant Patil user data from DB
        $vedantUsers = User::where('name', 'like', '%Vedant%')->get();
        foreach ($vedantUsers as $u) {
            DB::table('user_quiz_stats')->where('user_id', $u->id)->delete();
            DB::table('daily_quiz_attempts')->where('user_id', $u->id)->delete();
            DB::table('test_sessions')->where('user_id', $u->id)->delete();
            $u->delete();
        }
    }

    public function down(): void
    {
        // No rollback needed for data deletion
    }
};
