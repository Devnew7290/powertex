<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ลบข้อมูลเก่ากันพลาด
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ตัวอย่าง permission สำหรับ backend
        Permission::firstOrCreate(['name' => 'manage users']);
        Permission::firstOrCreate(['name' => 'view dashboard']);
        Permission::firstOrCreate(['name' => 'manage orders']);
        Permission::firstOrCreate(['name' => 'manage products']);

        // สร้าง role
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $developer  = Role::firstOrCreate(['name' => 'Developer']);
        $editor     = Role::firstOrCreate(['name' => 'Editor']);

        // assign permission ให้ super admin & developer
        $superAdmin->syncPermissions(Permission::all());
        $developer->syncPermissions(Permission::all());

        // editor มีเฉพาะ view dashboard & manage products
        $editor->syncPermissions(['view dashboard', 'manage products']);

        $user1 = User::find(1);
        $user1->assignRole($superAdmin);

        $user2 = User::find(2);
        $user2->assignRole($developer);
    }
}
