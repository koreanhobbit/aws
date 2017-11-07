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
        		'path'=>'storage/images/',
        		'type'=>'image/png',
        		'created_at'=> new \DateTime(),
        		'updated_at'=> new \DateTime()
        	]);
    }
}
