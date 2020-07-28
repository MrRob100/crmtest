<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $email = 'admin@admin.com';
        $admin = DB::table('users')->where('email', '=', $email)->first();

        if ($admin === null) {
          DB::table('users')->insert([
            'name' => 'admin',
            'email' => $email,
            'password' => Hash::make('password'),
          ]);
        } else {
          $message = 'user record for '.$email.' already in db';
          Log::info($message);
          echo($message)."\n";
        }
    }
}
