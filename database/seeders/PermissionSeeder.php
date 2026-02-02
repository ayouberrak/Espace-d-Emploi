<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'publier offres']);
        Permission::create(['name' => 'edit offres']);
        Permission::create(['name' => 'clotur offres']);

        Permission::create(['name' => 'view offres']);    
        Permission::create(['name' => 'postuler offres']);    

        Permission::create(['name' => 'view profile']);
        Permission::create(['name' => 'edit profile']);

        Permission::create(['name' => 'send_invi amie']);
        Permission::create(['name' => 'accept_invi amie']);
        Permission::create(['name' => 'decline_invi amie']);
        Permission::create(['name' => 'view amie']);

        $recruteur = Role::create(['name'=>'recruiter']);
        $devloppeur = Role::create(['name'=>'devloppeur']);

        $recruteur->givePermissionTo([
            'publier offres','edit offres','clotur offres','view profile','edit profile','send_invi amie','accept_invi amie','decline_invi amie','view amie'
        ]);
        $devloppeur->givePermissionTo([
            'view offres','postuler offres','view profile','edit profile','send_invi amie','accept_invi amie','decline_invi amie','view amie'
        ]);

    }
}
