<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Str;

class DemoUsersSeeder extends Seeder
{
    public function run()
    {
        User::insert($this->users()->toArray());
    }

    protected function users()
    {
        return collect([
            [
                'id' => Str::uuid(),
                'name' => 'Danyel',
                'last_name' => 'Alkeddah',
                'email' => 'danyel@alternativa.dev',
                'image' => null,
                'username' => 'danyelkeddah',
                'email_verified_at' => now(),
                'password' =>
                    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Serhat',
                'last_name' => 'Tanrikut',
                'email' => 'serhat@wodo.io',
                'image' => null,
                'username' => 'serhattanrikut',
                'email_verified_at' => now(),
                'password' =>
                    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Bekir',
                'last_name' => 'Dag',
                'email' => 'bekir@wodo.io',
                'image' => null,
                'username' => 'bekirdag',
                'email_verified_at' => now(),
                'password' =>
                    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
