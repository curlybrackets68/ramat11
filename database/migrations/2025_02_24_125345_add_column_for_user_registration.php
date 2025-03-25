<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable()->after('remember_token');
            $table->string('middle_name')->nullable()->after('first_name');
            $table->string('last_name')->nullable()->after('middle_name');
            $table->string('username')->nullable()->after('last_name');
            $table->integer('gender')->nullable()->comment('1 => male, 2 => female')->after('username');
            $table->string('attachment')->nullable()->after('gender');
            $table->integer('mobile')->nullable()->after('attachment');
            $table->integer('country')->nullable()->after('mobile');
            $table->integer('city')->nullable()->after('country');
            $table->integer('state')->nullable()->after('city');
            $table->integer('district')->nullable()->after('state');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
