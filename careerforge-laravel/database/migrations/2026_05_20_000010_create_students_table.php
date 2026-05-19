<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('students')) {
            return;
        }

        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->string('email', 100)->unique();
            $table->string('password', 255)->nullable();

            $table->string('image', 255)->nullable();
            $table->text('skills')->nullable();
            $table->text('interests')->nullable();
            $table->float('gpa')->nullable();
            $table->text('education')->nullable();
            $table->text('experience')->nullable();
            $table->text('projects')->nullable();

            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
