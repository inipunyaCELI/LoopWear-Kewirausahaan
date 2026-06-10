<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up()
    {
        Schema::table('vouchers', function (Blueprint $table) {
            $table->boolean('khusus_pengguna_baru')->default(false)->after('tipe');
        });
    }
    public function down()
    {
        Schema::table('vouchers', function (Blueprint $table) {
            $table->dropColumn('khusus_pengguna_baru');
        });
    }
};
