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
        Schema::create('avatars', function (Blueprint $table) {
            $table->id();
            $table->string('avatar_id')->nullable();
            $table->string('avatar_name')->nullable();
            $table->string('gender')->nullable();
            $table->longText('preview_image_url')->nullable();
            $table->longText('preview_video_url')->nullable();
            $table->string('type')->nullable();
            $table->string('group')->nullable();
            $table->boolean('favorite')->nullable()->default(false);
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
        Schema::dropIfExists('avatars');
    }
};
