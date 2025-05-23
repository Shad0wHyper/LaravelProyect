<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = ['Administrador','Docente','Estudiante'];
        foreach($roles as $r) {
            Role::firstOrCreate(
                ['name' => $r, 'guard_name' => 'web']
            );
        }
    }
}
