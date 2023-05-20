<?php
namespace App\Http\Controllers\Visit;


use App\Traits\ApiTraits;
use Laravel\Sanctum\Guard;
use App\Models\Visit\Visit;
use Illuminate\Http\Request;
use App\Models\Doctor\Doctor;
use App\Traits\CustomHelpers;
use App\Models\Patient\Patient;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreVisitRequest;
use App\Http\Requests\UpdateVisitRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\VisitPatientResource;

class VisitController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVisitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function DoctorDaysAvilable($id){
        $days = Visit::DoctorDaysAvilable($id);
        return ApiTraits::myData('Visit days display success', $days);
    }
    public function store(Request $request)
    {
        // $userservices=$this->AuthUser()->Service;//all services for auth doctor
         $request->validate([
                'doctor_id' => 'required|exists:doctors,id',
                'day' => 'required|exists:days,day',
                'phone' => 'required|regex:/^01[0125][0-9]{8}$/',

        ]);

        //all avilable days for auth pass doctor
        $days = Visit::DoctorDaysAvilable($request->doctor_id);

        $doctorDay = false;
        foreach ($days as $value) {
            if ($value == $request->day) {
                $doctorDay = true;
            }
        }


        if ($doctorDay == true) {
            $have_visit_same_today = Visit::where('day', $request->day)
                ->whereDate('created_at', '=', substr(date('Y-m-d H:i:s'), 0, 10))->where('patient_id',$this->AuthUser()->id)
                ->latest()
                ->first();
            if ($have_visit_same_today) {

                return ApiTraits::error('you have visit todat already please chick',$have_visit_same_today);

            } else {
                $today = Visit::where('day', $request->day)
                    ->whereDate('created_at', '=', substr(date('Y-m-d H:i:s'), 0, 10))
                    ->latest()
                    ->first();
                if ($today) {
                    if ($today->hour == 21) {
                        return ApiTraits::error('sorry this day is full please chose another day', $days);
                    } else {
                        $result = Visit::create([
                            'doctor_id' => $request->doctor_id,
                            'patient_id' => $this->AuthUser()->id,
                            'day' => $request->day,
                            'hour' => $today->hour + 1,
                            'phone' => $request->phone,
                        ]);
                        return ApiTraits::myData('Visit store success', $result);
                    }


                } else {
                    $result = Visit::create([
                        'doctor_id' => $request->doctor_id,
                        'patient_id' => $this->AuthUser()->id,
                        'day' => $request->day,
                        'hour' => 9,
                        'phone' => $request->phone,
                    ]);
                    return ApiTraits::myData('Visit store success', $result);

                }
            }

        } else {
            return ApiTraits::error('must be one of days avilable for doctor within this week', $days);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Visit\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function showPatientVisits()
    {
        $result=Visit::where('patient_id',$this->AuthUser()->id)
      ->get();
        $results=VisitPatientResource::collection($result);

        return ApiTraits::myData('Visit display success', $results);
    }

    public function showDoctorVisits()
    {
        $result=Visit::todayVisit();
        $result=VisitPatientResource::collection($result);    
    //     $result=Visit::
    //     whereDate('created_at', '=', substr(date('Y-m-d H:i:s'), 0, 10))
    //   ->where('doctor_id',$this->AuthUser()->id)
    //   ->get();
        return ApiTraits::myData('Visit display success', $result);
        
    }


    public function showVisits()
    {
        $result=Visit::all();
        $result=VisitPatientResource::collection($result);    
        return ApiTraits::myData('Visit display success', $result);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visit\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function destroy($visitId)
    {
        $validator = Validator::make(
        [
            "id" => $visitId,
        ]        
        , [
            'id' => 'required|exists:visits,id',
        ]);
 
        if ($validator->fails()) {
            return ApiTraits::error('this visit id not exist');
        }else{
            $result=Visit::
            whereDate('created_at', '=', substr(date('Y-m-d H:i:s'), 0, 10))
          ->where('patient_id',$this->AuthUser()->id)
          ->where('id',$visitId)
          ->delete();
            return ApiTraits::myData('Visit delete success', $result);
        }
        

    }
}