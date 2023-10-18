<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'admin',
            'author'
        ];

        collect($roles)->map(function ($name) {
            Role::query()
                ->updateOrCreate(compact('name'), compact('name'));
        });
    }
}
