<?php

namespace App\Models\Day;

use App\Models\Doctor\Doctor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Day extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'day',

        'created_at',
        'updated_at',
    ];


    protected $hidden = [
        // 'password',
        // 'remember_token',
    ];

    public function Doctor()
    {
        return $this->belongsToMany(Doctor::class, 'doctor__days', 'doctor_id', 'day_id');

    }
}
