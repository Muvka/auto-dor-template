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
        Schema::create('maintenance_road_section_telephones', function (Blueprint $table) {
            $table->id();
			$table->foreignId('maintenance_road_section_id')
				->constrained()
				->cascadeOnUpdate()
				->cascadeOnDelete()
				->index('maintenance_section_telephones_maintenance_section_id_foreign');
			$table->string('name', 64);
			$table->string('number', 32);
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
        Schema::dropIfExists('maintenance_road_section_telephones');
    }
};
