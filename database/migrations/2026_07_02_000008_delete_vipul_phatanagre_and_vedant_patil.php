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
        // 1. Delete Vedant Patil completely
        $vedantUsers = User::where('name', 'like', '%Vedant%')->orWhere('name', 'like', '%Patil%')->get();
        foreach ($vedantUsers as $u) {
            DB::table('user_quiz_stats')->where('user_id', $u->id)->delete();
            DB::table('daily_quiz_attempts')->where('user_id', $u->id)->delete();
            DB::table('test_sessions')->where('user_id', $u->id)->delete();
            if ($u->email) {
                DB::table('suggestions')->where('email', $u->email)->delete();
            }
            $u->delete();
        }

        // 2. Delete Vipul Phatanagre completely
        $vipulUsers = User::where('name', 'like', '%Vipul%')->orWhere('name', 'like', '%Phatanagre%')->get();
        foreach ($vipulUsers as $u) {
            DB::table('user_quiz_stats')->where('user_id', $u->id)->delete();
            DB::table('daily_quiz_attempts')->where('user_id', $u->id)->delete();
            DB::table('test_sessions')->where('user_id', $u->id)->delete();
            if ($u->email) {
                DB::table('suggestions')->where('email', $u->email)->delete();
            }
            $u->delete();
        }

        // 3. Delete suggestions by matching name
        DB::table('suggestions')->where('name', 'like', '%Vipul%')
                               ->orWhere('name', 'like', '%Phatanagre%')
                               ->orWhere('name', 'like', '%Vedant%')
                               ->orWhere('name', 'like', '%Patil%')
                               ->delete();
    }

    public function down(): void
    {
        // No rollback needed for data deletion
    }
};
