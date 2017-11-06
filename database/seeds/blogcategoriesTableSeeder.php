<?php

use Illuminate\Database\Seeder;

class blogcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blogcategories')->insert([
        		'category'=>'Miscelanous',
                'slug' => 'miscelanous',
        		'created_at'=> new \DateTime(),
        		'updated_at'=> new \DateTime()
        	]);
        DB::table('blogcategories')->insert([
        		'category'=>'News',
                'slug' => 'news',
        		'created_at'=> new \DateTime(),
        		'updated_at'=> new \DateTime()
        	]);
        DB::table('blogcategories')->insert([
        		'category'=>'Tutorial',
                'slug' => 'tutorial',
        		'created_at'=> new \DateTime(),
        		'updated_at'=> new \DateTime()
        	]);
        DB::table('blogcategories')->insert([
        		'category'=>'Promotion',
                'slug' => 'promotion',
        		'created_at'=> new \DateTime(),
        		'updated_at'=> new \DateTime()
        	]);
    }
}
