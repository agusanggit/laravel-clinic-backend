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
        Schema::create('patient_schedules', function (Blueprint $table) {
            $table->id();
            // patient_id foreign key
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            // doctor_id foreign key
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
            // schedule_time
            $table->dateTime('schedule_time');
            // complaint
            $table->text('complaint');
            //status enum('waiting','processing','canceled', 'completed')
            $table->enum('status', ['waiting','processing','processed','cancelled', 'completed']);
            //no_antrian
            $table->integer('no_antrian')->nullable();
            //payment method enum('cash','qris')
            $table->enum('payment_method', ['cash','qris'])->nullable();
            //total price
            $table->integer('total_price')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_schedules');
    }
};
