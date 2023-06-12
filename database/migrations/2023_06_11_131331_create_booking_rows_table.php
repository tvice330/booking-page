<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_rows', function (Blueprint $table) {
            $table->id();
            $table->date('arrival_date');
            $table->date('departure_date');
            $table->bigInteger('phone_number');
            $table->string('email',255);
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id')
                ->references('id')
                ->on('booking_statuses')
                ->nullOnDelete();
            $table->unique(['email','phone_number','arrival_date',]);
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
        Schema::dropIfExists('booking_rows');
    }
}
