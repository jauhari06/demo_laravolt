<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {

            $table->id(); 
            
            $table->string('author_id', 26);
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');  
            
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->text('content'); 
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};