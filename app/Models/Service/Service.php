<?php

namespace App\Models\Service;

use App\Models\Doctor\Doctor;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patienthistory\Patienthistory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'service',
        'price',
        'created_at',
        'updated_at',
    ];


    protected $hidden = [
        // 'password',
        // 'remember_token',
    ];

    public function Doctor()
    {
        return $this->belongsToMany(Doctor::class, 'doctors_services', 'doctor_id', 'service_id');

    }

    public function Patienthistory()
    {
        return $this->belongsToMany(Patienthistory::class, 'services_patienthistories', 'patienthistorie_id', 'service_id');

    }
}
