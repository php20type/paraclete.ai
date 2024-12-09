<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ImageCredit;

class ImageCreditsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ads = [
            ['id' => 1, 
                'sd_ultra' => 1,
                'sd_core' => 1,
                'sd_3_medium' => 1,
                'sd_3_large' => 1,
                'sd_3_large_turbo' => 1,
                'sd_v16' => 1,
                'sd_xl_v10' => 1,
                'openai_dalle_3_hd' => 1,
                'openai_dalle_3' => 1,
                'openai_dalle_2' => 1,
                'flux_pro' => 1,
                'flux_dev' => 1,
                'flux_schnell' => 1,
                'flux_realism' => 1,
            ]

        ];

        foreach ($ads as $ad) {
            ImageCredit::updateOrCreate(['id' => $ad['id']], $ad);
        }
    }
}
