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
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('code', 32)->unique();
            $table->text('original_url');
            $table->string('title')->nullable();
            $table->unsignedBigInteger('clicks')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamp('expires_at')->nullable();
            $table->json('metadata')->nullable();
            $table->index(['team_id', 'created_at']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('links');
    }
};
