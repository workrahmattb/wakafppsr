<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('datawakifs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alamat')->nullable();
            $table->string('notelpon');
            $table->date('tglwakaf');
            $table->integer('wakafpembangunan')->nullable();
            $table->integer('wakafproduktif')->nullable();
            $table->integer('donasipendidikan')->nullable();
            $table->string('banktransfer')->nullable();
            $table->string('image')->nullable();
            $table->string('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datawakifs');
    }
};
