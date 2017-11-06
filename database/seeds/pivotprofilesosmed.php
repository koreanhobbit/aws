<?php

use Illuminate\Database\Seeder;

class pivotprofilesosmed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profilesocialmedias_users')->insert([
        	'profilesocialmedia_id' => 2,
        	'user_id' => 1,
        	'link' => "https://facebook.com",
        ]);
    }
}
