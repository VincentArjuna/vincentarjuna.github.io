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
        Schema::create('pickup_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')
                ->nullable()
                ->constrained('transaksis', 'id')
                ->cascadeOnDelete();
            $table->foreignId('pelanggan_id');
            $table->foreignId('driver_id')
                ->nullable()
                ->constrained('users', 'id')
                ->cascadeOnDelete();
            $table->string('action');
            $table->boolean('is_done')->default(false);
            $table->text('alamat');
            $table->foreignId('modified_by')
                ->constrained('users', 'id')
                ->cascadeOnDelete();
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
        Schema::dropIfExists('pickup_deliveries');
    }
};
