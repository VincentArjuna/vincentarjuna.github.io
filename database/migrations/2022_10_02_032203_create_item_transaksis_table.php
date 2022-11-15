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
        Schema::create('item_transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('jenis_item_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->float('bobot_bucket')->default(0);
            $table->integer('harga_premium')->default(0);
            $table->string('status_proses');
            $table->foreignId('pencuci')
                ->nullable()
                ->constrained('users', 'id')
                ->cascadeOnDelete();
            $table->foreignId('penyetrika')
                ->nullable()
                ->constrained('users', 'id')
                ->cascadeOnDelete();
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
        Schema::dropIfExists('item_transaksis');
    }
};
