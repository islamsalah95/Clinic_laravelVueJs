<?php

namespace App\Models\Visit;

use Carbon\Carbon;
use App\Models\Doctor\Doctor;
use App\Traits\CustomHelpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patienthistory\Patienthistory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'doctor_id',
        'patient_id',
        'day',
        'hour',
        'phone' ,
        'created_at',
        'updated_at',
    ];


    protected $hidden = [
        // 'password',
        // 'remember_token',
    ];


    public function Patienthistory(): BelongsTo
    {
        return $this->belongsTo(Patienthistory::class, 'visit_id');

    }


    public function Doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');

    }





    public static function DoctorDaysAvilable($doctor_id)
    {

                      //all days avilable per week start from tomorrow
                      $avilable_per_week_days=CustomHelpers::avilableWeekDays();
                      //all avilable days for auth doctor
                      $Doctordays=Doctor::where('id',$doctor_id)->first()->Day;
                    //   $Doctordays=Doctor::find($doctor_id)->first()->Day;
                      foreach ($Doctordays as $Doctorday) {
                        $Doctordays[]=$Doctorday['day'] ;
                    }
                      $day=[];
                    foreach ($avilable_per_week_days as $avilable_per_week_day) {
                        foreach ($Doctordays as $Doctorday) {
                        if($avilable_per_week_day==$Doctorday){
                            $day[]=$avilable_per_week_day;
                        }
                        }
                    }
                    return $day; //all avilable days for auth pass doctor

    }




    public static function isToday($datetime)
    {

        $currentDateTime = date('Y-m-d H:i:s');
        return substr($datetime, 0, 10) === substr($currentDateTime, 0, 10);


    }

    public static function todayVisit()
    {        
        
            // Retrieve the authenticated user's visits
            $visits =Auth::guard("sanctum")->user()->Visit;
    
            // Filter the visits to only include records created today
            $todayVisits = $visits->filter(function ($visit) {
                return Carbon::parse($visit->day)->isToday();
            });
            
            // Return the filtered results
            return $todayVisits;
        }

}
