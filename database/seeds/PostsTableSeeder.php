<?php

use Illuminate\Database\Seeder;
use App\Models\Posts;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 一括削除
        Posts::truncate();

        //
        for ($k = 1; $k < 6; $k++) {
            for ($i = 1; $i < 16; $i++) {
              if ($i % 2 == 0) {
                Posts::create([
                  'user_id' => $k,
                  'title' => "title" . $i * $k,
                  'body' => "body" . $i * $k . "body" . $i * $k,
                  'publication' => "1"
                ]);
              } else {
                Posts::create([
                  'user_id' => $k,
                  'title' => "title" . $i * $k,
                  'body' => "body" . $i * $k . "body" . $i * $k,
                  'publication' => "0"
                ]);
              }
            }
        }
    }
}
