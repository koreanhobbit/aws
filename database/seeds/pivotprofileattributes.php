<?php

use Illuminate\Database\Seeder;

class pivotprofileattributes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profile_attributes_users')->insert([
        	'profileattribute_id' => 1,
        	'user_id' => 1,
        	'value' => 90,
        ]);
    }	
}
