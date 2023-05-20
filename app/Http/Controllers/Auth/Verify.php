<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Mail\VerifyPass;
use App\Traits\ApiTraits;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class Verify extends Controller
{
       public function Verify(Request $request, $Auth)
    {
        $request->validate([
            'code' => ['required'],
            'password' => ['required'],

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
