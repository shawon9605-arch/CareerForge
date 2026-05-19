<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('students')) {
            return;
        }

        Schema::table('students', function (Blueprint $table) {
            if (!Schema::hasColumn('students', 'image')) {
                $table->string('image', 255)->nullable();
            }
            if (!Schema::hasColumn('students', 'skills')) {
                $table->text('skills')->nullable();
            }
            if (!Schema::hasColumn('students', 'interests')) {
                $table->text('interests')->nullable();
            }
            if (!Schema::hasColumn('students', 'gpa')) {
                $table->float('gpa')->nullable();
            }
            if (!Schema::hasColumn('students', 'education')) {
                $table->text('education')->nullable();
            }
            if (!Schema::hasColumn('students', 'experience')) {
                $table->text('experience')->nullable();
            }
            if (!Schema::hasColumn('students', 'projects')) {
                $table->text('projects')->nullable();
            }
        });
    }

    public function down(): void
    {
        // No down migration to avoid destructive drops.
    }
};
