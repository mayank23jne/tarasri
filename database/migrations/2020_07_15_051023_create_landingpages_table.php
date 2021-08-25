<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandingpagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landingpages', function (Blueprint $table) {
            $table->id();
			$table->string('title')->nullable();
			$table->string('slug')->nullable();
			$table->string('show_position')->nullable()->comment="1:Main Menu ; 2 : Collection Menu";
			$table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('landingpages');
    }
}
