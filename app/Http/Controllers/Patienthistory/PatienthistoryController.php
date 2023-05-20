<?php
namespace App\Http\Controllers\Patienthistory;


use Carbon\Carbon;
use App\Traits\ApiTraits;
use App\Models\Visit\Visit;
use Illuminate\Http\Request;
use App\Models\Doctor\Doctor;
use App\Models\Patient\Patient;
use App\Models\Service\Service;
use App\Http\Controllers\Controller;
use App\Models\Patienthistory\Patienthistory;
use App\Http\Requests\StorePatienthistoryRequest;
use App\Http\Requests\UpdatePatienthistoryRequest;
use App\Http\Resources\showPatienthistoryDoctorResource;

class PatienthistoryController extends Controller
{



    public function store(Request $request)
    {
        $request->validate([
            'visit_id' => 'required|exists:visits,id',
            'service_id' => 'required|exists:services,id',
            'medcine_notice' => 'string|nullable',
    ]);


           $visitIdExist=Patienthistory::visitIdExist($request);

           if($visitIdExist==true){
           $isPatientHaveThisVisit= Visit::where('id',$request->visit_id)->first();
                $result= Patienthistory::create([
                    'doctor_id'=>$this->AuthUser()->id,
                    'patient_id'=>$isPatientHaveThisVisit->patient_id,
                    'visit_id'=>$request->visit_id,
                    'medcine_notice'=>$request->medcine_notice,
                ]);

                // for ($i=0; $i<sizeof($request->service_id);$i++) {
                //     $result->Service()->attach(Service::find($request->service_id[$i]));
                //     }
                $result->Service()->attach(Service::find($request->service_id));

                return ApiTraits::myData('Patienthistory store success', $result);



            }

    }


    public function showPatienthistoryDoctor($patientId)
    {
        $results= Patienthistory::where("patient_id",$patientId)->get();

        $results=showPatienthistoryDoctorResource::collection($results);

        return ApiTraits::myData('showPatienthistoryDoctor show success', $results);

    }


    public function showPatienthistoryPatient()
    {
        $results= Patienthistory::where("patient_id",$this->AuthUser()->id)->get();

        $results=showPatienthistoryDoctorResource::collection($results);

        return ApiTraits::myData('showPatienthistoryPatient show success', $results);
    }

    public function showAllPatientHistory()
    {
        $results= Patienthistory::all();

        $results=showPatienthistoryDoctorResource::collection($results);

        return ApiTraits::myData('showPatienthistoryPatient show success', $results);
    }




    

    
}
