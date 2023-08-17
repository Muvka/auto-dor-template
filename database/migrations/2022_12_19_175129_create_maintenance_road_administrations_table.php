<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
	{
        Schema::create('maintenance_road_administrations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->unsignedSmallInteger('employees_number')
				->default(0);
            $table->string('employees_document', 255)
				->nullable();
            $table->unsignedSmallInteger('buildings_number')
				->default(0);
			$table->string('buildings_map_url', 255)
				->nullable();
			$table->unsignedSmallInteger('asphalt_plants_number')
				->default(0);
			$table->string('asphalt_plants_map_url', 255)
				->nullable();
			$table->unsignedSmallInteger('maintained_roads_length')
				->default(0);
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
        Schema::dropIfExists('maintenance_road_administrations');
    }
};
