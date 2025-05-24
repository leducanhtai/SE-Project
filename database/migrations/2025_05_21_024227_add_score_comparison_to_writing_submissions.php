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
       Schema::table('writing_submissions', function (Blueprint $table) {
        $table->float('ai_score')->nullable()->change(); // nếu chưa nullable
        $table->float('score_change')->nullable();
        $table->boolean('score_increased')->nullable();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('writing_submissions', function (Blueprint $table) {
            //
        });
    }
};
