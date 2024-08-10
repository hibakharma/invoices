<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Role;

//use Spatie\Permission\Models\Permission;

class CreatAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create admin User and assign the role to him.
        $user = User::create([
            'name' => 'HibaKharma',
            'email' => 'hibakharma@gmail.com',
            'password' => Hash::make('123456'),
            'roles_name' => ["owner"],
            'Status'=> 'مفعل' ,
        ]);

        $role = Role::create(['name' => 'owner']);

        $permissions = Permission::all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
