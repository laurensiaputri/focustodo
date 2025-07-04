<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
{
    Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description')->nullable();
        $table->enum('priority', ['High', 'Medium', 'Low'])->default('Medium');
        $table->string('category')->nullable(); // Study, Work, Personal, etc.
        $table->date('deadline')->nullable();
        $table->enum('status', ['todo', 'in_progress', 'completed'])->default('todo');
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
