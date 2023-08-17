<?php

namespace Database\Seeders;

use Database\Seeders\Maintenance\RoadAdministrationSeeder;
use Database\Seeders\Maintenance\RoadSectionSeeder;
use Database\Seeders\User\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	public function run(): void
	{
		$this->call(
			[
				UserSeeder::class,
				RoadAdministrationSeeder::class,
				RoadSectionSeeder::class
			]
		);
	}
}
