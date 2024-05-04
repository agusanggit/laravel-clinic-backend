<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\NullableType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            // nik
            $table->string('nik');
            // kk
            $table->string('kk');
            // name
            $table->string('name');
            // phone
            $table->string('phone');
            // email - karena nggak wajib maka pakai nullable
            $table->string('email')->nullable();
            // gender enum male female tapi pada saai ini pakai string
            $table->string('gender');
            // birth_place
            $table->string('birth_place');
            // birth_date
            $table->string('birth_date');
            // is_deceased
            $table->boolean('is_deceased')->default(false);
            // address line
            $table->string('address_line');
            // city
            $table->string('city');
            // city code
            $table->string('city_code');
            // province
            $table->string('province');
            // province code
            $table->string('province_code');
            // district
            $table->string('district');
            // district code
            $table->string('district_code');
            // village
            $table->string('village');
            // village code
            $table->string('village_code');
            // rt
            $table->string('rt');
            // rw
            $table->string('rw');
            // postal code
            $table->string('postal_code');
            // marital status
            $table->string('marital_status');
            // relationship name
            $table->string('relationship_name')->nullable();
            // relationship phone
            $table->string('relationship_phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
