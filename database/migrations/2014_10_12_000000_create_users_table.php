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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->unsignedBigInteger('id_sexe')->nullable();
            $table->foreign('id_sexe')->references('id')->on('sexe')->onDelete('set null');
            $table->string('matricule')->nullable();
            $table->string('cin')->nullable();
            $table->string('sexe')->nullable();
            $table->string('lasteName_fr')->nullable();
            $table->string('firstName_fr')->nullable();
            $table->string('lasteName_ar')->nullable();
            $table->string('firstName_ar')->nullable();
            $table->date('dateBirth')->nullable();
            $table->string('placeBirth')->nullable();
            $table->date('recrutementDate')->nullable();
            $table->string('zipCode')->nullable();
            $table->string('cityAdresse')->nullable();
            $table->string('address')->nullable();
            $table->string('phoneNumber')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
