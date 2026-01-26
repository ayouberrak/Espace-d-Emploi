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
        Schema::create( 'users' , function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->index();
            $table->string('password');
            $table->enum('role',['devloppeur','recruiter']);
            $table->string('photo')->nullable();
            $table->text('bio')->nullable();
            $table->string('phone')->nullable();
            $table->jsonb('amis')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        DB::statement("DROP TYPE IF EXISTS user_role");
    }
};
