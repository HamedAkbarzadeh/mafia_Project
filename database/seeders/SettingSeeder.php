<?php

namespace Database\Seeders;

use App\Models\Setting\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'title' => 'Citizen Game',
            'description' => 'Web Site Citizen Game',
            'subject' => 'Citizen Game',
            'whiteLogo' => url('images/defult-image/whiteLogo.png'),
            'blackLogo' => url('images/defult-image/blackLogo.png'),
            'icon' =>  url('images/defult-image/ghavanin.png'),
            'ruleImage' =>  url('images/defult-image/ghavanin.png'),
            'bannerImage' =>  url('images/defult-image/banner.png'),
            // 'keywords' => 'citizen game',
        ]);
    }
}
