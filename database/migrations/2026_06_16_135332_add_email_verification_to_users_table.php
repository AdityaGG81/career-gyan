<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'email_otp')) {
                $table->string('email_otp')->nullable();
            }
            if (!Schema::hasColumn('users', 'email_verified_at')) {
                $table->timestamp('email_verified_at')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = [];
            if (Schema::hasColumn('users', 'email_otp')) {
                $columns[] = 'email_otp';
            }
            if (Schema::hasColumn('users', 'email_verified_at')) {
                $columns[] = 'email_verified_at';
            }
            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};