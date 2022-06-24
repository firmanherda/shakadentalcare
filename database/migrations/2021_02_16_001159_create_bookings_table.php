<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('slot_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('pasien_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('service_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->enum('status', ['Menunggu Antrian', 'Diproses', 'Dilewati', 'Selesai']);
            $table->dateTime('tanggal')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
