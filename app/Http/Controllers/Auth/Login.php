<?php

namespace App\Http\Controllers\Auth;

use App\Traits\ApiTraits;
use App\Models\User;
use App\Models\Admin\Admin;
use App\Models\Nurse\Nurse;
use App\Models\Doctor\Doctor;
use App\Models\Patient\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class Login extends Controller
{

    public function login(Request $request, $Auth)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $Authenticatable= WhichUser::WhichUser($Auth);

        if (isset($Authenticatable)) {
            $user = $Authenticatable::where('email', $request->email)->first();

            if ($user) {
                if ( Hash::check($request->password, $user->password)) {
                    $tokens = $user->createToken('Android')->plainTextToken;
                    $user->token = 'Bearer ' . $tokens;
                    // if (is_null($user->email_verified_at)) {
                    //     return ApiTraits::myData('not Verified',compact('user')); 
                    // }
                    return ApiTraits::myData('login success',$user);
                }else{
                    return ApiTraits::error('wrong password');
                }

            } else {
                return ApiTraits::error('login fail this email not in this role please make sure choese right role login', $user); //401unauthorithed
            }


        }


    }
}