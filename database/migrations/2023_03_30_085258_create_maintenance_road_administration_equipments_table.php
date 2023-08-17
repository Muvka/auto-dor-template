<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('maintenance_road_administration_equipments', function (Blueprint $table) {
            $table->id();
			$table->foreignId('maintenance_road_administration_id')
				->constrained()
				->cascadeOnUpdate()
				->cascadeOnDelete()
				->index('maintenance_equipment_maintenance_administration_id_foreign');
			$table->unsignedSmallInteger('passenger_cars_number')
				->default(0);
			$table->unsignedSmallInteger('dump_trucks_number')
				->default(0);
			$table->unsignedSmallInteger('kdm_number')
				->default(0);
			$table->unsignedSmallInteger('motor_graders_number')
				->default(0);
			$table->unsignedSmallInteger('front_loaders_number')
				->default(0);
			$table->unsignedSmallInteger('wheeled_tractors_number')
				->default(0);
			$table->unsignedSmallInteger('caterpillar_tractors_number')
				->default(0);
			$table->unsignedSmallInteger('road_rollers_number')
				->default(0);
			$table->unsignedSmallInteger('excavators_number')
				->default(0);
			$table->unsignedSmallInteger('buses_number')
				->default(0);
			$table->unsignedSmallInteger('trailers_number')
				->default(0);
			$table->unsignedSmallInteger('trailer_equipments_number')
				->default(0);
			$table->unsignedSmallInteger('tow_trucks_number')
				->default(0);
			$table->unsignedSmallInteger('pavers_number')
				->default(0);
			$table->unsignedSmallInteger('distributors_number')
				->default(0);
			$table->unsignedSmallInteger('other_construction_number')
				->default(0);
			$table->unsignedSmallInteger('other_exploitation_number')
				->default(0);
			$table->unsignedSmallInteger('other_other_number')
				->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_road_administration_equipments');
    }
};
