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
        Schema::table('projects', function (Blueprint $table) {
            // Drop the existing student_id column
            $table->dropForeign(['student_id']);
            $table->dropColumn('student_id');

            // Add the student_id column with the correct foreign key constraint
            $table->string('student_id');
            $table->foreign('student_id')->references('student_id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Drop the modified student_id column
            $table->dropForeign(['student_id']);
            $table->dropColumn('student_id');

            // Add the original student_id column back
            $table->foreignId('student_id')->nullable()->constrained('users')->onDelete('set null');
        });
    }
};
