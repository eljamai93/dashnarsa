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
        Schema::create('detailGrade', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained(
                table: 'users', indexName: 'user_grade'
            )
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('grade_id')->constrained(
                table: 'grades', indexName: 'id'
            )
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('gradeSeniority');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailGrade');
    }
};
