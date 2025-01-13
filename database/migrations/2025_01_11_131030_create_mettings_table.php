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
        Schema::create('mettings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departements_id')->references('id')->on('departements')->onDelete('CASCADE');
            $table->string('title');
            $table->timestamp('start_at');
            $table->timestamp('end_at');
            $table->longText('notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mettings');
    }
};
