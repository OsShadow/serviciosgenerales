<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Roles;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // DB::table('users')->insert
        $userAdmin = User::create
        ([
            'code'=>'1',
            'name'=>'Usuario Admin',
            'lastname'=>'Admin',
            'email'=>'admin@admin.com',
            'email_verified_at'=>'2020-07-18 07:18:07',
            'password'=>Hash::make('admin'),
            'created_at'=>'2020-07-18 07:18:07',
            'updated_at'=>'2020-07-18 07:18:07'
        ]);

        $userAdmin->assignRole('Admin');
    }
}
