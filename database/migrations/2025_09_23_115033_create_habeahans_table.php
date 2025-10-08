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
        Schema::create('habeahans', function (Blueprint $table) {
            $table->id();
            $table->string('identifier')->unique();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->unsignedInteger('sundut');
            $table->unsignedInteger('urutan_lahir');
            $table->unsignedInteger('jumlah_saudara');
            $table->foreignId('parent_id')->nullable()->references('id')->on('habeahans')->onDelete('set null'); // relasi ke orang tua
            $table->string('wilayah')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habeahans');
    }
};
