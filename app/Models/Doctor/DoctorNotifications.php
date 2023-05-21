<?php

namespace App\Models\Doctor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorNotifications extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'desc',
        'patient_id',
        'created_at',
        'updated_at',
    ];

    
}
