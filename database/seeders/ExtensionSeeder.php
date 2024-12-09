<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExtensionSetting;

class ExtensionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ads = [
            ['id' => 1],

        ];

        foreach ($ads as $ad) {
            ExtensionSetting::updateOrCreate(['id' => $ad['id']], $ad);
        }
    }
}
