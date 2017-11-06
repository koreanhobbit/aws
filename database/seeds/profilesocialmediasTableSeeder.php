<?php

use Illuminate\Database\Seeder;

class profilesocialmediasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profilesocialmedias')->insert([
            'name' => 'website',
            'link' => '',
            'icon' => 'desktop',
            
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ]);

        DB::table('profilesocialmedias')->insert([
    		'name' => 'facebook',
            'link' => 'http://www.facebook.com/',
            'icon' => 'facebook',
            
    		'created_at' => new \DateTime(),
    		'updated_at' => new \DateTime(),
        ]);

        DB::table('profilesocialmedias')->insert([
    		'name' => 'twitter',
            'link' => 'http://www.twitter.com/',
            'icon' => 'twitter',
         
    		'created_at' => new \DateTime(),
    		'updated_at' => new \DateTime(),
        ]);

        DB::table('profilesocialmedias')->insert([
    		'name' => 'instagram',
            'link' => 'http://www.instagram.com/',
            'icon' => 'instagram',
          
    		'created_at' => new \DateTime(),
    		'updated_at' => new \DateTime(),
        ]);

        DB::table('profilesocialmedias')->insert([
            'name' => 'linkedin',
            'link' => 'http://www.linkedin.com/',
            'icon' => 'linkedin',
           
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ]);

        DB::table('profilesocialmedias')->insert([
            'name' => 'youtube',
            'link' => 'http://www.youtube.com/',
            'icon' => 'youtube',
         
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ]);

        DB::table('profilesocialmedias')->insert([
            'name' => 'Facebook Messenger',
            'link' => 'https://m.me/',
            'icon' => 'comments',
          
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ]);

        DB::table('profilesocialmedias')->insert([
            'name' => 'Whatsapp',
            'link' => 'https://api.whatsapp.com/send?phone=',
            'icon' => 'whatsapp',
           
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ]);


    }
}
