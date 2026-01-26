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
        Schema::create('profiles', function(Blueprint $table){
            $table->id();
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');
            
            // $table->unsignedBigInteger('user_id'); referance users.id

            // $table->foreign('user_id') 
            //     ->references('id')
            //     ->on('users');

            $table->string('title');
            $table->text('bio');
            $table->jsonb('skills')->nullable();
            // array .......
            $table->jsonb('experiances')->nullable();

            // arayy .............
            $table->jsonb('projects')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
