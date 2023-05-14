<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Traits\ApiTraits;
use App\Models\Admin\Admin;
use App\Models\Nurse\Nurse;
use Illuminate\Http\Request;
use App\Models\Doctor\Doctor;
use App\Models\Patient\Patient;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\WgichUser;

class Verify extends Controller
{
       public function Verify(Request $request, $Auth)
    {
        $request->validate([
            'code' => 'required|digits:6',
            'password' => 'required',
        ]);

        $Authenticatable= WhichUser::WhichUser($Auth);

        if (isset($Authenticatable)) {
            $user = $Authenticatable::where('code',$request->code)->first();

            if ($user) {
                $Authenticatable->where('code',$user->code)->update(['code' => null,'password' => bcrypt($request->password)]);
                return ApiTraits::myData('password update success'); 
        
            } else {
                return ApiTraits::error('code is wrong', $user); 
            }


        }


    }
}
