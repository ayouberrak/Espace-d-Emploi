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
        Schema::create('invi' , function(Blueprint $table){
            $table->id();
            $table->foreignId('sender_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->foreignId('resever_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->string('status')->default('pending');
            $table->timestamp('created_at');

            
        });
        DB::statement(" ALTER TABLE invi ADD CONSTRAINT status_check CHECK (status IN ('pending', 'accepted', 'refused'))");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE invi DROP CONSTRAINT IF EXISTS status_check");
        Schema::dropIfExists('invi');
    }
};
