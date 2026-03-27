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
		Schema::create('mangas', function (Blueprint $table) {
			$table->id();

			$table->string('title');
			$table->text('description')->nullable();
			$table->string('cover_image')->nullable();
			$table->integer('volumes')->nullable();
			$table->year('year')->nullable();
			$table->enum('status', ['ongoing', 'completed', 'hiatus'])->default('ongoing');
			$table->foreignId('author_id')->constrained();
			$table->foreignId('publisher_id')->constrained();

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('mangas');
	}
};
