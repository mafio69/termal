<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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

        /// USER

        DB::table('users')->insert([
            'role_id' => 1,
            'name' => 'Mariusz Franciszczak',
            'email' => 'mariusz@designmf.pl',
            'password' => bcrypt('szymek'),
            'created_at' => date('Y-m-d G:i:s'),
        ]);

    }
}
