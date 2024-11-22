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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('descriptionShort');
            $table->string('pngPath');
            $table->text('descriptionLong');
            $table->string('pathGitHub');
            $table->string('pathUrl')->nullable();
        });
    }

    /**
     *
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
