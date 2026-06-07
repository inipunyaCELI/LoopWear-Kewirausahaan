<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->enum('tipe', ['persen', 'nominal', 'gratis_ongkir']);
            $table->decimal('nilai', 10, 2)->default(0);
            $table->decimal('min_belanja', 10, 2)->default(0);
            $table->integer('kuota')->nullable();
            $table->integer('terpakai')->default(0);
            $table->date('berlaku_hingga')->nullable();
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
