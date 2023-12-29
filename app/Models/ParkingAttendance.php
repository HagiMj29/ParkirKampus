<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParkingAttendance extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'photo',
    ];

    public function getPhotoUrlAttribute()
    {
        return asset(Storage::url('image/' . $this->photo));
    }

}
