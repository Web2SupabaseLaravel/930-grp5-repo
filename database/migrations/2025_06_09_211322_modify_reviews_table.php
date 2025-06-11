<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Drop existing foreign keys
            $table->dropForeign(['user_id']);
            $table->dropForeign(['course_id']);
            
            // Change user_id column type
            $table->unsignedBigInteger('user_id')->change();
            
            // Add back foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            
            // Add timestamps if they don't exist
            if (!Schema::hasColumn('reviews', 'created_at')) {
                $table->timestamps();
            }
        });
    }

    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Drop foreign keys
            $table->dropForeign(['user_id']);
            $table->dropForeign(['course_id']);
            
            // Change user_id back to uuid
            $table->uuid('user_id')->change();
            
            // Add back foreign keys with original configuration
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            
            // Remove timestamps if they were added
            $table->dropTimestamps();
        });
    }
};
