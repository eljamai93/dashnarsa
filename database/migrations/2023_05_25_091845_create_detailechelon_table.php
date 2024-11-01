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
        Schema::create('detailEchelon', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained(
                table: 'users', indexName: 'user_echelon'
            )
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('echelon_id')->constrained(
                table: 'echelons', indexName: 'detail_echelon'
            )
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->string('echelonSeniority');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailEchelon');
    }
};
