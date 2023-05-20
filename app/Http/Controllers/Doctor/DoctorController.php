<?php
namespace App\Http\Controllers\Doctor;


use App\Traits\ApiTraits;
use App\Models\Doctor\Doctor;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\NurseResource;
use App\Http\Requests\StoreDoctorRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\DoctorInfoResource;

class DoctorController extends Controller
{

    public function store(StoreDoctorRequest $request)
    {
        $password = bcrypt($request->password); 
        $result=Doctor::create(array_merge($request->all(), ['password' => $password]));

        return ApiTraits::myData('store doctor success',$result); 
    }


    public function destroy($id)
    {
        $validator = Validator::make(['id'=>$id], [
            'id' => 'required|exists:doctors,id',
        ]);
 
        if ($validator->fails()) {
            return ApiTraits::error('this doctor id not exist');
        }else{
            $result=Doctor::where('id',$id)->delete();
            return ApiTraits::myData('delete doctor success',$result); 
        }

    }


    public function show()
    {
        $results=Doctor::all();
        $results=DoctorInfoResource::collection($results);


        return ApiTraits::myData('display doctors success',$results); 
    }



    public function showDoctorNurses($id)
    {
        $results=Doctor::findOrFail($id)->Nurse;
        $results=NurseResource::collection($results);
        return ApiTraits::myData('display Nurses for spacific doctor',$results); 
    }

    public function showDoctorPatient($doctorId)
    {
        $results = DB::table('doctors')
        ->select('doctors.id as doctor_id', 'doctors.name as doctor_name', 'doctors.department_id', 'patienthistories.patient_id as patient_id', 'patients.name as patient_Name')
        ->join('patienthistories', 'doctors.id', '=', 'patienthistories.doctor_id')
        ->join('patients', 'patients.id', '=', 'patienthistories.patient_id')
        ->where('doctors.id', '=', $doctorId) // add the doctor_id filter
        ->groupBy('doctors.id', 'patienthistories.patient_id','doctors.name','doctors.department_id','patients.name')
        ->get();
    return ApiTraits::myData('display all doctor patients',$results); 
    }





    

   
}
