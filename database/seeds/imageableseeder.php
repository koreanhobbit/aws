<?php

use Illuminate\Database\Seeder;

class imageableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('imageables')->insert([
        	'image_id' => 1,
        	'imageable_id' => 1,
        	'imageable_type' => "App\User",
        	'is_maskot' => 0,
        ]);
    }
}
