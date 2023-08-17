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
        Schema::create('maintenance_road_problems', function (Blueprint $table) {
            $table->id();
			$table->string('address', 150);
			$table->text('comment');
			$table->string('telephone', 32);
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
        Schema::dropIfExists('maintenance_road_problems');
    }
};
