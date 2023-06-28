<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_user', function (Blueprint $table) {
            $table->foreignId('event_id')->constrained('events')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('mafia_id')->nullable()->constrained('mafias')->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['event_id' , 'user_id']);
            $table->tinyInteger('payment_status')->default(0)->comment('0 => no pay , 1 => payment');
            $table->tinyInteger('win_status')->nullable()->comment('0 => falied , 1 => winner');
            $table->tinyInteger('side')->nullable()->comment('0 => citizen , 1 => mafia , 2 => independent');
            $table->text('random_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_user');
    }
}
