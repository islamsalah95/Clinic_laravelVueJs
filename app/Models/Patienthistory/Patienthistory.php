<?php

namespace App\Models\Patienthistory;

use App\Traits\ApiTraits;
use App\Models\Visit\Visit;
use App\Models\Doctor\Doctor;
use App\Models\Patient\Patient;
use App\Models\Service\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patienthistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'doctor_id',
        'patient_id',
        'visit_id',
        'medcine_notice',
        'created_at',
        'updated_at',
    ];


    protected $hidden = [
        // 'password',
        // 'remember_token',
    ];

    public function Patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');

    }
    public function Doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');

    }


    public function Visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');

    }
    public function Service()
    {
        return $this->belongsToMany(Service::class, 'services_patienthistories', 'patienthistorie_id', 'service_id');

    }


    
    public static function visitIdExist($request)
    {
    $todayVisits=Visit::todayVisit();
    $visit_id_exist=false;
       foreach ($todayVisits as  $todayVisit) {
       if ( $todayVisit->id == $request->visit_id) {
        $visit_id_exist=true;
       }else {
        return ApiTraits::error('wrong visit id', $todayVisits);
       }
       }
       return $visit_id_exist;
    }
}
