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
    public function up()
    {
        Schema::create('services_patienthistories', function (Blueprint $table) {
            $table->unsignedBigInteger("patienthistorie_id");
            $table->unsignedBigInteger("service_id");

            $table->foreign('patienthistorie_id')->references('id')->on('patienthistories')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');   
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
        Schema::dropIfExists('services_patienthistories');
    }
};
