<?php

namespace App\Models\Doctor;

use App\Models\Day\Day;
use App\Models\Nurse\Nurse;
use App\Models\Visit\Visit;
use App\Models\Service\Service;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Department\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Patienthistory\Patienthistory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'code',
        'department_id',
        'password',
        'created_at',
        'updated_at',
    ];


    protected $hidden = [
        // 'password',
        // 'remember_token',
    ];

    public function Nurse(): HasMany
    {
        return $this->hasMany(Nurse::class, 'doctor_id');

    }


    public function Day()
    {
        return $this->belongsToMany(Day::class, 'doctor__days', 'doctor_id', 'day_id');

    }

    public function Service()
    {
        return $this->belongsToMany(Service::class, 'doctors_services', 'doctor_id', 'service_id');

    }

    public function Patienthistory(): HasMany
    {
        return $this->hasMany(Patienthistory::class, 'doctor_id');

    }

    public function Visit(): HasMany
    {
        return $this->hasMany(Visit::class, 'doctor_id');

    }

    public function Department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

}
