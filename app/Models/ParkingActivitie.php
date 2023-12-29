<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingActivitie extends Model
{
    
    use HasFactory;
    protected $primaryKey ='id';
    
    protected $fillable = [
        'user_id',
        'slot_id',
        'vehicle_number',
        'vehicle_brand',
        'in_datetime',
        'out_datetime',
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
