<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
        	"site_title" => "Top Web Studio",
        	"tagline" => "WE SHARE YOUR DREAMS",
            "created_at" => new \DateTime(),
            "updated_at" => new \DateTime(),
        ]);
    }
}
