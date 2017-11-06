<?php

use Illuminate\Database\Seeder;

class WebSocialMediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('websitesocmeds')->insert([
        	"name" => "facebook",
        	"link" => "http://www.facebook.com/",
            "icon" => "facebook",
            "setting_id" =>1,
        	"created_at" => new \DateTime(),
        	"updated_at" => new \DateTime(),
        ]);

        DB::table('websitesocmeds')->insert([
        	"name" => "instagram",
        	"link" => "http://www.instagram.com/",
            "icon" => "instagram",
            "setting_id" =>1,
        	"created_at" => new \DateTime(),
        	"updated_at" => new \DateTime(),
        ]);

        DB::table('websitesocmeds')->insert([
        	"name" => "twitter",
        	"link" => "http://www.twitter.com/",
            "icon" => "twitter",
            "setting_id" =>1,
        	"created_at" => new \DateTime(),
        	"updated_at" => new \DateTime(),
        ]);

        DB::table('websitesocmeds')->insert([
            "name" => "Facebook Messenger",
            "link" => "https://m.me/",
            "icon" => "comments",
            "setting_id" =>1,
            "created_at" => new \DateTime(),
            "updated_at" => new \DateTime(),
        ]);

        DB::table('websitesocmeds')->insert([
            "name" => "Whatsapp",
            "link" => "https://api.whatsapp.com/send?phone=",
            "icon" => "whatsapp",
            "setting_id" =>1,
            "created_at" => new \DateTime(),
            "updated_at" => new \DateTime(),
        ]);
    }
}
