<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(): void
	{
		Schema::create('maintenance_road_administration_vacancies', function (Blueprint $table) {
			$table->id();
			$table->foreignId('maintenance_road_administration_id')
				->constrained()
				->cascadeOnUpdate()
				->cascadeOnDelete()
				->index('maintenance_vacancy_maintenance_administration_id_foreign');
			$table->string('name', 128);
			$table->unsignedSmallInteger('number');
			$table->unsignedInteger('sort')
				->default(0);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(): void
	{
		Schema::dropIfExists('maintenance_road_administration_vacancies');
	}
};
