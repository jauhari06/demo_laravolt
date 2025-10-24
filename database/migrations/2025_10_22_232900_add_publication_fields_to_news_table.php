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
    {Schema::table('news', function (Blueprint $table) {
        
        Schema::table('news', function (Blueprint $table) {
        
            $table->string('status')->default('draft')->after('content');

            $table->char('approved_by', 26)->nullable()->after('status');
            
            $table->foreign('approved_by')->references('id')->on('users');

            $table->timestamp('approved_at')->nullable()->after('approved_by');
        });
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropForeign(['approved_by']); 
            $table->dropColumn(['status', 'approved_by', 'approved_at']);
        });
    }
};
