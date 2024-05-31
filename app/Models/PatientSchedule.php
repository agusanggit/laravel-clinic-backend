<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientSchedule extends Model
{
    use HasFactory;

    // $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
    // $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
    // $table->dateTime('schedule_time');
    // $table->text('complaint');
    // $table->enum('status', ['waiting','processing','processed','cancelled', 'completed']);
    // $table->integer('no_antrian')->nullable();
    // $table->enum('payment_method', ['cash','qris']);
    // $table->integer('total_price');

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'schedule_time',
        'complaint',
        'status',
        'no_antrian',
        'payment_method',
        'total_price',

    ];

    // foreign key patient
    public function patient () {

        return $this->belongsTo(Patient::class);

    }

    // foreign key doctor
    public function doctor () {

        return $this->belongsTo(Doctor::class);

    }

}
