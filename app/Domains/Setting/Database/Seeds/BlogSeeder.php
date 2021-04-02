<?php

namespace App\Domains\Setting\Database\Seeds;

use DB;
use Illuminate\Database\Seeder;
use App\Domains\Setting\Entities\Blog;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        DB::table("blogs")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

        $data = [];
        for ($i=0; $i < 5; $i++) {
            if ($i % 2 != 0) {
                $is_promoted = config("system.answers.yes");
                $status      = config("system.status.active");
            } else {
                $is_promoted = config("system.answers.no");
                $status      = config("system.status.deactivate");
            }
            $data []= [
                "name_en"        => "Blog [EN] ( {$i} )",
                "name_ar"        => "الخبر بالعربى ( {$i} )",
                "data" =>[
                    "description_en" => "Description [EN] ( {$i} )",
                    "description_ar" => "وصف الخبر بالعربى ( {$i} )",
                ],
                "order"       => $i,
                "status"      => config("system.status.active"),
                "category_id" => rand(1, 5),
                "author_id"   => rand(1, 3),
                "editor_id"   => rand(1, 3),
            ];
        }
        foreach ($data as $item) {
            Blog::create($item);
        }
    }
}
