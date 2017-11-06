<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        		'name'=>'ferry',
        		'email'=>'ferryaze1@gmail.com',
        		'job_title'=>'CEO',
        		'password'=>bcrypt('hobbitx'),
                'user_status' => 1,
        		'created_at'=> new \DateTime(),
        		'updated_at'=> new \DateTime()
        	]);
    }
}
