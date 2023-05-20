<?php
namespace App\Http\Controllers\Service;


use App\Traits\ApiTraits;
use Illuminate\Http\Request;
use App\Models\Service\Service;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreServiceRequest;

class ServiceController extends Controller
{

    public function store(StoreServiceRequest $request)
    {
        $result=Service::create($request->all());

        return ApiTraits::myData('store Service success',$result); 
    }


    public function destroy($id)
    {
        $validator = Validator::make(['id'=>$id], [
            'id' => 'required|exists:services,id',
        ]);
 
        if ($validator->fails()) {
            return ApiTraits::error('this Service id not exist');
        }else{
            $result=Service::where('id',$id)->delete();
            return ApiTraits::myData('delete Service success',$result); 
        }

    }


    public function show()
    {
        $results=Service::all();

        return ApiTraits::myData('display Services success',$results); 
    }

    public function showDoctorServices()
    {
        $results=$this->AuthUser()->Service;

        return ApiTraits::myData('display Services success',$results); 
    }


    public function update(StoreServiceRequest $request,$id)
    {
        $validator = Validator::make(['id'=>$id], [
            'id' => 'required|exists:services,id',
        ]);

 
        if ($validator->fails()) {
            return ApiTraits::error('this Service id not exist');
        }else{
            $result=Service::where('id', $id)->update(['service' => $request->service]);
            return ApiTraits::myData('update Service success',$result);  
        }

    }

}
