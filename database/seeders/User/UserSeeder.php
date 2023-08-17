<?php

namespace Database\Seeders\User;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_data = [
			'name' => 'Admin',
			'email' => 'admin@localhost.ru',
			'password' => Hash::make('testuser')
		];

		$admin = User::updateOrCreate($admin_data);

		$admin->is_admin = true;
		$admin->save();
    }
}
