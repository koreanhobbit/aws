<?php

use Illuminate\Database\Seeder;

class RoleSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
        	'name' => 'Super Admin',
        	'slug' => 'super_admin',
        	'permissions' => json_encode([
        		'access-blog' => true,
                'access-portfolio' => true,
        	]),
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ]);

        DB::table('roles')->insert([
        	'name' => 'Team Member',
        	'slug' => 'team_member',
        	'permissions' => json_encode([
        		'access-blog' => true,
                'access-portfolio' => true,
        	]),
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ]);

        DB::table('roles')->insert([
            'name' => 'Editor',
            'slug' => 'editor',
            'permissions' => json_encode([
                'access-blog' => true,
            ]),
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ]);
    }
}
