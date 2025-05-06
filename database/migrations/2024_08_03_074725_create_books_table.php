<?php

use App\Models\User;
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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->integer('gutenberg_id')->unique();
            $table->string('title');
            $table->string('author')->nullable();
            $table->text('description')->nullable();
            $table->string('cover_url')->nullable();
            $table->string('download_url')->nullable();
            $table->string('read_url')->nullable(); // optional, same as download_url if no viewer
            $table->text('subjects')->nullable();
            $table->text('bookshelves')->nullable();
            $table->string('language')->nullable();
            $table->string('media_type')->nullable();
            $table->integer('download_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
