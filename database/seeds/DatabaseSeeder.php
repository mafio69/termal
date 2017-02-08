<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(RolesTableSeeder::class);
       // $this->call(UsersTableSeeder::class);

        DB::table('roles')->insert([
            'id' => 1,
            'type' => 'admin',
            'created_at' => date('Y-m-d G:i:s'),
        ]);
        DB::table('roles')->insert([
            'id' => 2,
            'type' => 'moderator',
            'created_at' => date('Y-m-d G:i:s'),
        ]);
        DB::table('roles')->insert([
            'id' => 3,
            'type' => 'user',
            'created_at' =>date('Y-m-d G:i:s') ,
        ]);


    }
}
