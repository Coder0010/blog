<?php

namespace App\Domains\Setting\Database\Seeds;

use DB;
use Illuminate\Database\Seeder;
use App\Domains\Setting\Entities\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        DB::table("settings")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");
        $general = [
            [
                "key" => "name",
                "data" => "aqarmap",
            ],
            [
                "key" => "description",
                "data" => "website description en",
            ],
            [
                "key" => "keywords",
                "data" => "aqarmap",
            ],
        ];

        $navbar = [
            [
                "key" => "navbar_trans_home",
                "data" => "Home",
            ],
            [
                "key" => "navbar_trans_categories",
                "data" => "Categories",
            ],
            [
                "key" => "navbar_trans_blogs",
                "data" => "Blogs",
            ],
        ];

        $mutli = array_merge(
            $general,
            $navbar,
        );
        $multi_lang_data = [];
        foreach ($mutli as $item) {
            foreach (AppLanguages() as $lang) {
                $multi_lang_data[] = [
                    "key"  => $item["key"]."_".$lang,
                    "data" => $item["data"],
                ];
            }
        }
        $settings = array_merge($multi_lang_data, );
        foreach ($multi_lang_data as $data) {
            Setting::create($data);
        }
    }
}
