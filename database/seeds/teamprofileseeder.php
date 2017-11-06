<?php

use Illuminate\Database\Seeder;

class teamprofileseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teamprofiles')->insert([
        	'user_id' => 1,
        	'month' => 02,
        	'date' => 01,
        	'year' => 1984,
        	'birthday' => "1984-02-01",
        	'location' => "Jakarta",
        	'description' => "I am a serial entrepreneur!",
        	'created_at' => new \DateTime(),
        	'updated_at' => new \DateTime(),
        ]);
    }
}
