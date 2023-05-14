<?php
namespace App\Http\Controllers\Nurse;


use App\Traits\ApiTraits;
use App\Models\Nurse\Nurse;
use App\Models\Doctor\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Resources\NurseResource;
use App\Http\Requests\StoreNurseRequest;
use App\Http\Requests\UpdateNurseRequest;
use Illuminate\Support\Facades\Validator;

class NurseController extends Controller
{

    public function store(StoreNurseRequest $request)
    {
        $result=Nurse::create($request->all());

        return ApiTraits::myData('store Nurse success',$result); 
    }


    public function destroy($id)
    {
        $validator = Validator::make(['id'=>$id], [
            'id' => 'required|exists:nurses,id',
        ]);
 
        if ($validator->fails()) {
            return ApiTraits::error('this Nurse id not exist');
        }else{
            $result=Nurse::where('id',$id)->delete();
            return ApiTraits::myData('delete Nurse success',$result); 
        }

    }


    public function show()
    {
        $results=Nurse::all();

        return ApiTraits::myData('display Nurses success',$results); 
    }



}
