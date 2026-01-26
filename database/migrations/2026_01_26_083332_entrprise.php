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
        Schema::create('entrprise' , function(Blueprint $table){
            $table->id();
            $table->string('nom');
            $table->string('logo')->nullable();
            $table->text('description');
            $table->string('location');
            $table->foreignId('recruiter_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('create');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrprise');
    }
};
