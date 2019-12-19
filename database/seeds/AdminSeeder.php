<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $checkAdmin = User::where('email','admin@admin.com')->first();
        if (!$checkAdmin){
            $admin = new  User();
            $admin->name = "Admin";
            $admin->email = 'admin@admin.com';
            $admin->password = Hash::make('admin123');
            $admin->role = 'admin';
            $admin->save();
            $this->command->info('Admin Created Successfully With credentials below:');
            $this->command->info('Email:  admin@admin.com'. "\nPassword: admin123");
            return;
        }
        $this->command->info('Admin Already exists!');
    }
}
