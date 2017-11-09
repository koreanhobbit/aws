<?php

use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
        		'name'=>'noimg.png',
        		'size'=>9999,
        		'path'=>'img/noimg.png',
        		'type'=>'image/png',
                'user_id' => '1',
        		'created_at'=> new \DateTime(),
        		'updated_at'=> new \DateTime()
        	]);
    }
}
