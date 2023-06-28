<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\User\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SetupOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where([['email' , 'hmddev2002@gmail.com'] , ['user_type' , 1]])->first();
        if($user == null){
            $user = User::create([
                'name' => 'HmD',
                'email' => 'hmddev2002@gmail.com',
                'password' => Hash::make(12344321),
                'user_type' => 1,
                'mobile' => 9331434614,
                'status' => 1,
            ]);
        }
        $developer = Role::where('name' , 'developer')->first();
        $user->roles()->attach($developer);


    }
}
