<?php

use Illuminate\Database\Seeder;

class ImageMidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('image_mids')->insert([
        	'name' => 'no_img',
        	'location' => 'img/noimg_thumbnail.png',
        	'size' => '12',
        	'type' => 'image/jpg',
        	'image_id' => 1,
        	'created_at' => new DateTime(),
        	'updated_at' => new DateTime(),
        ]);
    }
}
