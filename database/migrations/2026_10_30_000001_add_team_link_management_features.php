<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('link_folders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->string('name', 100);
            $table->string('color', 20)->default('zinc');
            $table->unsignedInteger('position')->default(0);
            $table->timestamps();
            $table->unique(['team_id', 'name']);
            $table->index(['team_id', 'position']);
        });

        Schema::create('link_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->string('name', 100);
            $table->string('slug', 120);
            $table->timestamps();
            $table->unique(['team_id', 'slug']);
        });

        Schema::create('link_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->string('name', 60);
            $table->string('slug', 80);
            $table->timestamps();
            $table->unique(['team_id', 'slug']);
        });

        Schema::create('link_campaigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name', 150);
            $table->string('channel', 30)->default('sms');
            $table->text('destination_url');
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->index(['team_id', 'created_at']);
        });

        Schema::table('links', function (Blueprint $table) {
            $table->foreignId('folder_id')->nullable()->constrained('link_folders')->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('link_categories')->nullOnDelete();
            $table->foreignId('campaign_id')->nullable()->constrained('link_campaigns')->nullOnDelete();
            $table->index(['team_id', 'folder_id']);
            $table->index(['team_id', 'category_id']);
            $table->index(['team_id', 'campaign_id']);
        });

        Schema::create('link_tag_link', function (Blueprint $table) {
            $table->id();
            $table->foreignId('link_id')->constrained()->cascadeOnDelete();
            $table->foreignId('link_tag_id')->constrained('link_tags')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['link_id', 'link_tag_id']);
            $table->index('link_tag_id');
        });

        Schema::create('link_campaign_recipients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->foreignId('campaign_id')->constrained('link_campaigns')->cascadeOnDelete();
            $table->foreignId('link_id')->nullable()->unique()->constrained()->nullOnDelete();
            $table->string('token', 64)->unique();
            $table->string('name', 150)->nullable();
            $table->text('phone')->nullable();
            $table->string('status', 30)->default('ready');
            $table->timestamp('clicked_at')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->index(['team_id', 'campaign_id']);
            $table->index(['campaign_id', 'status']);
        });

        Schema::table('link_clicks', function (Blueprint $table) {
            $table->string('device_type', 30)->nullable();
            $table->string('browser', 60)->nullable();
            $table->string('platform', 60)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('link_clicks', function (Blueprint $table) {
            $table->dropColumn(['device_type', 'browser', 'platform']);
        });

        Schema::dropIfExists('link_campaign_recipients');
        Schema::dropIfExists('link_tag_link');

        Schema::table('links', function (Blueprint $table) {
            $table->dropIndex(['team_id', 'folder_id']);
            $table->dropIndex(['team_id', 'category_id']);
            $table->dropIndex(['team_id', 'campaign_id']);
            $table->dropConstrainedForeignId('folder_id');
            $table->dropConstrainedForeignId('category_id');
            $table->dropConstrainedForeignId('campaign_id');
        });

        Schema::dropIfExists('link_campaigns');
        Schema::dropIfExists('link_tags');
        Schema::dropIfExists('link_categories');
        Schema::dropIfExists('link_folders');
    }
};
