<?php

namespace App\Domains\Auth\Database\Seeds;

use DB;
use Illuminate\Database\Seeder;
use App\Domains\Auth\Entities\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        DB::table("comments")->truncate();
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
                "user_id"          => 5,
                "commentable_id"   => $i+1,
                "commentable_type" => "App\Domains\Setting\Entities\Blog",
                "message"          => "good blog ${i}"
            ];
        }
        foreach ($data as $item) {
            Comment::create($item);
        }
    }
}
