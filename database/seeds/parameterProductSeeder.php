<?php

use Illuminate\Database\Seeder;

class parameterProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parameters')->insert([
        	'name' => 'Production Time',
        	'id_name' => 'time_product',
        	'placeholder' => 'Production length time',
        	'created_at' => new \DateTime(),
    		'updated_at' => new \DateTime(),
        ]);

        DB::table('parameters')->insert([
        	'name' => 'Style Info',
        	'id_name' => 'style_info_product',
        	'placeholder' => 'Info style of the product',
        	'created_at' => new \DateTime(),
    		'updated_at' => new \DateTime(),
        ]);

        DB::table('parameters')->insert([
        	'name' => 'Style Options',
        	'id_name' => 'style_option_product',
        	'placeholder' => 'How many style options are available?',
        	'created_at' => new \DateTime(),
    		'updated_at' => new \DateTime(),
        ]);

        DB::table('parameters')->insert([
        	'name' => 'CMS Info',
        	'id_name' => 'cms_product',
        	'placeholder' => 'Info about CMS',
        	'created_at' => new \DateTime(),
    		'updated_at' => new \DateTime(),
        ]);

        DB::table('parameters')->insert([
        	'name' => 'Hosting Info',
        	'id_name' => 'hosting_product',
        	'placeholder' => 'Info Hosting',
        	'created_at' => new \DateTime(),
    		'updated_at' => new \DateTime(),
        ]);

        DB::table('parameters')->insert([
        	'name' => 'Chat Messenger',
        	'id_name' => 'chat_product',
        	'placeholder' => 'Info about chat messenger',
        	'created_at' => new \DateTime(),
    		'updated_at' => new \DateTime(),
        ]);

        DB::table('parameters')->insert([
        	'name' => 'Support Info',
        	'id_name' => 'support_product',
        	'placeholder' => 'Info about support from developer',
        	'created_at' => new \DateTime(),
    		'updated_at' => new \DateTime(),
        ]);
    }
}
