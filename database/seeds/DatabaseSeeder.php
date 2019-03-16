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
        app('db.connection')->table('users')->insert([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => app('hash')->make('secret'),
        ]);
    }
}