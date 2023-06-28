<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventMafiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_mafia', function (Blueprint $table) {
            $table->foreignId('event_id')->constrained('events')->onUpdate('cascade')->onDelete('cascade'); 
            $table->foreignId('mafia_id')->constrained('mafias')->onUpdate('cascade')->onDelete('cascade'); 
            $table->primary(['event_id' , 'mafia_id']);
            $table->tinyInteger('side')->nullable()->comment('0 => citizents , 1 => mafias , 2 => independents'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_mafia');
    }
}
