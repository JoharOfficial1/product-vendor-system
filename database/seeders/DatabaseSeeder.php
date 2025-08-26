<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password')
        ]);

        $vendor = User::factory()->create([
            'name' => 'Vendor User',
            'email' => 'vendor@example.com',
            'password' => bcrypt('password')
        ]);

        Product::create([
            'user_id' => $vendor->id,
            'name' => 'Product 1',
            'description' => 'This is the first sample product.',
            'price' => 49.99,
            'code' => generateProductCode(),
        ]);

        Product::create([
            'user_id' => $vendor->id,
            'name' => 'Product 2',
            'description' => 'This is the second sample product.',
            'price' => 79.99,
            'code' => generateProductCode(),
        ]);

        Role::create(['name' => 'admin', 'guard_name' => 'web']);
        Role::create(['name' => 'vendor', 'guard_name' => 'web']);

        $admin->assignRole('admin');
        $vendor->assignRole('vendor');
    }
}
