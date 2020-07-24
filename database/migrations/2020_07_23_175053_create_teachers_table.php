<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     * dni
     * cuil.
     * fnac
     * telefono
     * email.
     * photo
     * domicilio
     * numlegajo.
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('dni')->unique();
            $table->string('cuil')->nullable();
            $table->string('fnac');
            $table->string('phone');
            $table->string('photo')->nullable();
            $table->string('email');
            $table->string('address');
            $table->string('docket')->nullable();

            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('teachers');
    }
}
