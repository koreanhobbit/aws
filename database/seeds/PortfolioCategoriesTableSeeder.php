<?php

use Illuminate\Database\Seeder;

class PortfolioCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('portfolio_categories')->insert([
        	'category' => 'Graphic Design',
        	'slug' => 'graphic_design',
        	'created_at' => new \DateTime(),
        	'updated_at' => new \DateTime(),
        ]);

        DB::table('portfolio_categories')->insert([
        	'category' => 'Website Design',
        	'slug' => 'website_design',
        	'created_at' => new \DateTime(),
        	'updated_at' => new \DateTime(),
        ]);

        DB::table('portfolio_categories')->insert([
        	'category' => 'App Design',
        	'slug' => 'app_design',
        	'created_at' => new \DateTime(),
        	'updated_at' => new \DateTime(),
        ]);

        DB::table('portfolio_categories')->insert([
			'category' => 'Website Development',
        	'slug' => 'website_development',
        	'created_at' => new \DateTime(),
        	'updated_at' => new \DateTime(),
        ]);

        DB::table('portfolio_categories')->insert([
			'category' => 'App Development',
        	'slug' => 'app_development',
        	'created_at' => new \DateTime(),
        	'updated_at' => new \DateTime(),
        ]);

        DB::table('portfolio_categories')->insert([
			'category' => 'Start-Up Development',
        	'slug' => 'start_up_development',
        	'created_at' => new \DateTime(),
        	'updated_at' => new \DateTime(),
        ]);

        DB::table('portfolio_categories')->insert([
			'category' => 'Miscelanous',
        	'slug' => 'miscelanous',
        	'created_at' => new \DateTime(),
        	'updated_at' => new \DateTime(),
        ]);
    }
}
