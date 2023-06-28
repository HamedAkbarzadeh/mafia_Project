<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type_game')->default(0)->comment('0 => classic And Modern ,1 => Modern');
            $table->decimal('price',20,3);
            $table->string('god_names')->nullable();
            $table->tinyInteger('vip_game')->nullable()->comment('0 => not vip , 1 => vip');
            $table->integer('amount_of_players');
            $table->tinyInteger('game_status')->default(0)->comment('0 => not over , 1 => over');
            $table->decimal('pay_citizen_win',20,3)->nullable();
            $table->decimal('pay_mafia_win',20,3)->nullable();
            $table->decimal('pay_independent_win',20,3)->nullable();
            $table->tinyInteger('side_win')->default(0)->comment('0 => citizens , 1 => mafia , 2 => independents');
            $table->tinyInteger('complation_status')->default(0)->comment('0 => not complation , 1 => complation ');
            $table->timestamp('start_date')->default(now());
            $table->text('image')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
