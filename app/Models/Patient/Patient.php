<?php

namespace App\Models\Patient;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Patient extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'name',
        'email',
        'age',
        'password',
        'created_at',
        'updated_at',
    ];


    protected $hidden = [
        // 'password',
        // 'remember_token',
    ];


    public function Patienthistory(): HasMany
    {
        return $this->hasMany(Patienthistory::class, 'patient_id');

    }
}
