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
        Schema::create('image_credits', function (Blueprint $table) {
            $table->id();
            $table->integer('sd_ultra')->nullable()->default(1);
            $table->integer('sd_core')->nullable()->default(1);
            $table->integer('sd_3_medium')->nullable()->default(1);
            $table->integer('sd_3_large')->nullable()->default(1);
            $table->integer('sd_3_large_turbo')->nullable()->default(1);
            $table->integer('sd_v16')->nullable()->default(1);
            $table->integer('sd_xl_v10')->nullable()->default(1);
            $table->integer('openai_dalle_3_hd')->nullable()->default(1);
            $table->integer('openai_dalle_3')->nullable()->default(1);
            $table->integer('openai_dalle_2')->nullable()->default(1);
            $table->integer('flux_pro')->nullable()->default(1);
            $table->integer('flux_dev')->nullable()->default(1);
            $table->integer('flux_schnell')->nullable()->default(1);
            $table->integer('flux_realism')->nullable()->default(1);
            $table->integer('pebblely_create_background')->nullable()->default(1);
            $table->integer('pebblely_remove_background')->nullable()->default(1);
            $table->integer('pebblely_upscale')->nullable()->default(1);
            $table->integer('pebblely_inpaint')->nullable()->default(1);
            $table->integer('pebblely_outpaint')->nullable()->default(1);
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
        Schema::dropIfExists('image_credits');
    }
};
