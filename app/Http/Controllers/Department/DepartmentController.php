<?php
namespace App\Http\Controllers\Department;


use App\Traits\ApiTraits;
use App\Http\Controllers\Controller;
use App\Models\Department\Department;
use App\Http\Resources\DoctorResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\DepartmentResource;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreDepartmentRequest;

class DepartmentController extends Controller
{
    public function store(StoreDepartmentRequest $request)
    {
        $result=Department::create($request->all());

        return ApiTraits::myData('store Department success',$result); 
    }


    public function destroy($id)
    {
        $validator = Validator::make(['id'=>$id], [
            'id' => 'required|exists:departments,id',
        ]);
 
        if ($validator->fails()) {
            return ApiTraits::error('this Department id not exist');
        }else{
            $result=Department::where('id',$id)->delete();
            return ApiTraits::myData('delete Department success',$result); 
        }

    }


    public function show()
    {
        $results=Department::all();
        $results=DepartmentResource::collection($results);

        return ApiTraits::myData('display Departments success',$results); 
    }

    public function DepartmentDoctors($id)
    {
        $results=Department::findOrFail($id)->Doctor;
        $results=DoctorResource::collection($results);
        
        return ApiTraits::myData('display  doctors',$results); 
    }


    public function update(StoreDepartmentRequest $request,$id)
    {
        $validator = Validator::make(['id'=>$id], [
            'id' => 'required|exists:departments,id',
        ]);

 
        if ($validator->fails()) {
            return ApiTraits::error('this Department id not exist');
        }else{
            $result=Department::where('id', $id)->update(['department' => $request->department]);
            return ApiTraits::myData('update Department success',$result);  
        }

    }
}
