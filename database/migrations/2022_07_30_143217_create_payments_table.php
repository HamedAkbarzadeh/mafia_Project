<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount',20,3);
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreignId('event_id')->constrained('events')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreignId('mafia_id')->nullable()->constrained('mafias')->onDelete('cascade')->onUpdate('cascade');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('type')->default(0)->comment('0 => online, 1 =>offline , 2 => cash');
            $table->unsignedBigInteger('paymentable_id');
            $table->string('paymentable_type');
            $table->text('random_code')->nullable();
            $table->tinyInteger('payment_status')->default(0);
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
        Schema::dropIfExists('payments');
    }
}
