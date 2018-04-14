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
        factory(App\User::class)->create([
            'name' => 'Robert McKenney',
            'email' => 'robert@mckenney.ca',
            'password' => Hash::make('secret')
        ]);

        factory(App\User::class)->create([
            'name' => 'Robert McKenney',
            'email' => 'mckennr@algonquincollege.com',
            'password' => Hash::make('secret')
        ]);
    }
}
