<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingComplaint extends Model
{
    use HasFactory;

    protected $primaryKey ='id';
    
    protected $fillable = [
        'user_id',
        'slot_id',
        'description',
        'reply',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function slot()
    {
        return $this->belongsTo('App\Models\ParkingSlot', 'slot_id', 'id');
    }
}
