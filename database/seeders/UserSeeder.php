<?php

namespace Database\Seeders;

use App\Models\User;
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
        $user = User::factory(5)->create();
        
        $user = User::first();
        $user->name = 'Administrator';
        // $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi //password
        $user->email = 'admin@gmail.com';
        $user->role_id = 1;
        $user->save();
    }
}
