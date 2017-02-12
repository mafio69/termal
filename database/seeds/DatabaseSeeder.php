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
       // $this->call(UsersTableSeeder::class)
///////////////////////////////// USERS        //////
   /*     DB::table('users')->insert([
            'role_id' => 1,
            'name' => 'Mariusz Franciszczak',
            'email' => 'mariusz@designmf.pl',
            'password' => bcrypt('szymek'),
            'created_at' => date('Y-m-d G:i:s'),
        ]);*/
///////////////////////////////////////ROLES
     /*   DB::table('roles')->insert([
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
        ]);*/
/////////////////////////////////////////////////STATUSES
   /*      DB::table('statuses')->insert([
        'id' => 1,
        'name' => 'Nieokreślony',
        'created_at' => date('Y-m-d G:i:s'),
    ]);
       DB::table('statuses')->insert([
            'id' => 2,
            'name' => 'Potencjalny klient',
            'created_at' => date('Y-m-d G:i:s'),
        ]);
        DB::table('statuses')->insert([
            'id' => 3,
            'name' => 'Klient',
            'created_at' => date('Y-m-d G:i:s'),
        ]);
        DB::table('statuses')->insert([
            'id' => 4,
            'name' => 'Kluczowy klient',
            'created_at' => date('Y-m-d G:i:s'),
        ]);
        DB::table('statuses')->insert([
            'id' => 5,
            'name' => 'Nie zainteresowany',
            'created_at' => date('Y-m-d G:i:s'),
        ]);
        DB::table('statuses')->insert([
            'id' => 6,
            'name' => 'Drobny klient',
            'created_at' => date('Y-m-d G:i:s'),
        ]); */
 ///////////////////// Create typeEvent
         DB::table('event_types')->insert([
        'id' => 1,
        'type' => 'telefon',
        'created_at' => date('Y-m-d G:i:s'),
    ]);
          DB::table('event_types')->insert([
        'id' => 2,
        'type' => 'notatka',
        'created_at' => date('Y-m-d G:i:s'),
    ]);
           DB::table('event_types')->insert([
        'id' => 3,
        'type' => 'spotkanie',
        'created_at' => date('Y-m-d G:i:s'),
    ]);
            DB::table('event_types')->insert([
        'id' => 4,
        'type' => 'email',
        'created_at' => date('Y-m-d G:i:s'),
    ]);

    }
}
