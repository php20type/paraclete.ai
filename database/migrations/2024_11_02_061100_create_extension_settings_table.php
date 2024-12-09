<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extension_settings', function (Blueprint $table) {
            $table->id();
            $table->string('plagiarism_api')->nullable();
            $table->boolean('plagiarism_feature')->default(false);
            $table->boolean('plagiarism_free_tier')->default(false);
            $table->boolean('detector_feature')->default(false);
            $table->boolean('detector_free_tier')->default(false);
            $table->string('flux_api')->nullable();
            $table->string('pebblely_api')->nullable();
            $table->boolean('pebblely_feature')->default(false);
            $table->boolean('pebblely_free_tier')->default(false);
            $table->string('voice_clone_elevenlabs_api')->nullable();
            $table->boolean('voice_clone_feature')->default(false);
            $table->boolean('voice_clone_free_tier')->default(false);
            $table->integer('voice_clone_limit')->nullable()->default(0);
            $table->boolean('sound_studio_feature')->default(false);
            $table->boolean('sound_studio_free_tier')->default(false);
            $table->integer('sound_studio_max_merge_files')->nullable()->default(1);
            $table->integer('sound_studio_max_audio_size')->nullable()->default(1);
            $table->string('photo_studio_stability_api')->nullable();
            $table->boolean('photo_studio_feature')->default(false);
            $table->boolean('photo_studio_free_tier')->default(false);
            $table->string('video_image_stability_api')->nullable();
            $table->boolean('video_image_feature')->default(false);
            $table->boolean('video_image_free_tier')->default(false);
            $table->integer('video_image_credits_per_video')->nullable()->default(1);
            $table->boolean('integration_wordpress_feature')->default(false);
            $table->boolean('integration_wordpress_free_tier')->default(false);
            $table->boolean('integration_wordpress_auto_post')->default(false);
            $table->integer('integration_wordpress_website_numbers')->nullable()->default(1);
            $table->integer('integration_wordpress_post_numbers')->nullable()->default(1);
            $table->string('heygen_api')->nullable();
            $table->boolean('heygen_avatar_feature')->nullable()->default(0);
            $table->boolean('heygen_avatar_free_tier')->nullable()->default(0);
            $table->boolean('heygen_avatar_video')->nullable()->default(0);
            $table->boolean('heygen_avatar_image')->nullable()->default(0);
            $table->integer('heygen_avatar_video_numbers')->nullable()->default(0);
            $table->integer('heygen_avatar_image_numbers')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extension_settings');
    }
};
