<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceMedicines extends Model
{
    use HasFactory;

    // //name
    // $table->string('name');
    // //category enum('medicine','consultation','treatment')
    // $table->enum('category', ['medicine','consultation','treatment']);
    // //price
    // $table->decimal('price', 15, 2);
    // //quantity
    // $table->integer('quantity')->nullable();

    protected $fillable = [
        'name',
        'category',
        'price',
        'quantity',

    ];
}
