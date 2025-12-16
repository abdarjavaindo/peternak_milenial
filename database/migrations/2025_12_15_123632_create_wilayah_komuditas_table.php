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
        Schema::create('wilayah_komuditas', function (Blueprint $table) {
            $table->id();
            $table->string('kabupaten')->nullable();
            $table->string('jml_sapi_potong')->default('0');
            $table->string('jml_sapi_perah')->default('0');
            $table->string('jml_kerbau')->default('0');
            $table->string('jml_dombakambing')->default('0');
            $table->string('jml_babi')->default('0');
            $table->string('jml_ayam_petelur')->default('0');
            $table->string('jml_ayam_pedaging')->default('0');
            $table->string('jml_burung_puyuh')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wilayah_komuditas');
    }
};
