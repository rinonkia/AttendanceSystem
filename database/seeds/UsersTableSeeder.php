<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'name' => '管理者',
                    'loginid' => 'admin',
                    'password' => Hash::make('password'),
                    'role' => 5,
                ],
                [
                    'name' => 'test_user',
                    'loginid' => 'user001',
                    'password' => 'user001',
                    'role' => 10,
                ],
            ]);
        factory(App\User::class, 20)->create();
    }
}
