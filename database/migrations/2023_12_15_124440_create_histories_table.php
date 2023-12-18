<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {          
            $table->id();
            $table->string('doctorName');
            $table->string('idDoctor');
            $table->string('patientName');
            $table->string('idPatient');
            $table->string('dateRegister');
            $table->string('statusPatient');
            $table->string('recordPatient');
            $table->string('evolutionPatient');
            $table->string('concept');
            $table->string('recommendation'); 
            $table->json('patientImage');
            $table->boolean('confirmedPatient');                        
            $table->timestamps();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('histories');
    }
}
