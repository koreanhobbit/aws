<?php

use Illuminate\Database\Seeder;

class CreateProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_categories')->insert([
        	'name' => 'Graphic Design',
        	'slug' => 'graphic_design',
        	'created_at' => new \DateTime(),
        	'updated_at' => new \DateTime(),
        ]);

        DB::table('product_categories')->insert([
        	'name' => 'Website Design',
        	'slug' => 'website_design',
        	'created_at' => new \DateTime(),
        	'updated_at' => new \DateTime(),
        ]);

        DB::table('product_categories')->insert([
        	'name' => 'App Design',
        	'slug' => 'app_design',
        	'created_at' => new \DateTime(),
        	'updated_at' => new \DateTime(),
        ]);

        DB::table('product_categories')->insert([
			'name' => 'Website Development',
        	'slug' => 'website_development',
        	'created_at' => new \DateTime(),
        	'updated_at' => new \DateTime(),
        ]);

        DB::table('product_categories')->insert([
			'name' => 'App Development',
        	'slug' => 'app_development',
        	'created_at' => new \DateTime(),
        	'updated_at' => new \DateTime(),
        ]);

        DB::table('product_categories')->insert([
			'name' => 'Start-Up Development',
        	'slug' => 'start_up_development',
        	'created_at' => new \DateTime(),
        	'updated_at' => new \DateTime(),
        ]);

        DB::table('product_categories')->insert([
			'name' => 'Miscelanous',
        	'slug' => 'miscelanous',
        	'created_at' => new \DateTime(),
        	'updated_at' => new \DateTime(),
        ]);
    }
}
