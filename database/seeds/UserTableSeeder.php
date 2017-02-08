<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id' => 1,
            'name' => 'Mariusz Franciszczak',
            'email' => 'mariusz@designmf.pl',
            'password' => bcrypt('szymek'),
            'created_at' => date('Y-m-d G:i:s'),
        ]);
    }
}
