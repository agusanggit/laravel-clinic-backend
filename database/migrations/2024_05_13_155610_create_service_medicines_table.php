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
        Schema::create('service_medicines', function (Blueprint $table) {
            $table->id();
            //name
            $table->string('name');
            //category enum('medicine','consultation','treatment')
            $table->enum('category', ['medicine','consultation','treatment']);
            //price
            $table->decimal('price', 15, 2);
            //quantity
            $table->integer('quantity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_medicines');
    }
};
