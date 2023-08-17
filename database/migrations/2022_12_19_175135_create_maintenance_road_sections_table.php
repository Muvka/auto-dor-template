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
        Schema::create('maintenance_road_sections', function (Blueprint $table) {
            $table->id();
			$table->foreignId('maintenance_municipal_area_id')
				->constrained()
				->cascadeOnUpdate()
				->restrictOnDelete();
            $table->foreignId('maintenance_road_administration_id')
				->constrained()
				->cascadeOnUpdate()
				->restrictOnDelete()
				->index('maintenance_sections_maintenance_administration_id_foreign');
            $table->string('name', 64);
			$table->string('head', 64);
			$table->string('address', 150);
			$table->string('email', 64)
				->nullable();
			$table->string('maintenance_url', 255)
				->nullable();
			$table->string('repair_url', 255)
				->nullable();
			$table->string('monitoring_url', 255)
				->nullable();
			$table->string('information_url', 255)
				->nullable();
            $table->boolean('status')
				->default(false);
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
        Schema::dropIfExists('maintenance_road_sections');
    }
};
