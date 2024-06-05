<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->string('priority');
            $table->string('image_path')->nullable();
            $table->boolean('status');
            $table->foreignId('assigned_to')->constrained("users");
            $table->foreignId('user_id')->constrained("users");
            $table->foreignId('update_by')->constrained("users");
            $table->foreignId('project_id')->constrained("projects");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
