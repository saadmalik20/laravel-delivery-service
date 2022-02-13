<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id', 'biker_id', 'pickup_address', 'delivery_address', 'status', 'pickup_time'
    ];

    const STATUS = [
        0 => 'waiting',
        1 => 'picked',
        2 => 'delivered'
    ];

}
