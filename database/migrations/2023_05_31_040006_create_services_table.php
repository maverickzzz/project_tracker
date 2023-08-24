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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->references('id')->on('users');
            $table->string('type')->unique();
            $table->integer('owner_id')->references('id')->on('project_owners');
            $table->integer('project_id')->references('id')->on('projects');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('currency');
            $table->integer('amount');
            $table->text('notes')->nullable();
            $table->boolean('is_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
