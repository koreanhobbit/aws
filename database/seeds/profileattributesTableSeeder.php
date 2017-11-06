<?php

use Illuminate\Database\Seeder;

class profileattributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profileattributes')->insert([
        	'name' => 'HTML',
        	'created_at' => new \DateTime(),
    		'updated_at' => new \DateTime(),
        ]);

        DB::table('profileattributes')->insert([
        	'name' => 'CSS',
        	'created_at' => new \DateTime(),
    		'updated_at' => new \DateTime(),
        ]);

        DB::table('profileattributes')->insert([
        	'name' => 'Javascript',
        	'created_at' => new \DateTime(),
    		'updated_at' => new \DateTime(),
        ]);

        DB::table('profileattributes')->insert([
        	'name' => 'MySQL',
        	'created_at' => new \DateTime(),
    		'updated_at' => new \DateTime(),
        ]);

        DB::table('profileattributes')->insert([
        	'name' => 'PHP',
        	'created_at' => new \DateTime(),
    		'updated_at' => new \DateTime(),
        ]);

        DB::table('profileattributes')->insert([
        	'name' => 'Code Igniter',
        	'created_at' => new \DateTime(),
    		'updated_at' => new \DateTime(),
        ]);

        DB::table('profileattributes')->insert([
        	'name' => 'Laravel',
        	'created_at' => new \DateTime(),
    		'updated_at' => new \DateTime(),
        ]);

        DB::table('profileattributes')->insert([
        	'name' => 'Angular',
        	'created_at' => new \DateTime(),
    		'updated_at' => new \DateTime(),
        ]);

        DB::table('profileattributes')->insert([
        	'name' => 'React',
        	'created_at' => new \DateTime(),
    		'updated_at' => new \DateTime(),
        ]);

        DB::table('profileattributes')->insert([
        	'name' => 'Vue',
        	'created_at' => new \DateTime(),
    		'updated_at' => new \DateTime(),
        ]);

        DB::table('profileattributes')->insert([
        	'name' => 'Java',
        	'created_at' => new \DateTime(),
    		'updated_at' => new \DateTime(),
        ]);

        DB::table('profileattributes')->insert([
        	'name' => 'Swift',
        	'created_at' => new \DateTime(),
    		'updated_at' => new \DateTime(),
        ]);

        DB::table('profileattributes')->insert([
        	'name' => 'Python',
        	'created_at' => new \DateTime(),
    		'updated_at' => new \DateTime(),
        ]);
    }
}
