<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
public function up(): void
{
    Schema::table('mbarangs', function (Blueprint $table) {
        $table->string('warna')->nullable()->after('kategori');
    });
}
public function down(): void
{
    Schema::table('mbarangs', function (Blueprint $table) {
        $table->dropColumn('warna');
    });
}
};
