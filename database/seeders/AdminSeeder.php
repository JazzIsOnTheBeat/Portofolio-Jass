<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@jass.com'],
            [
                'name' => 'Jass',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );
    }
}
