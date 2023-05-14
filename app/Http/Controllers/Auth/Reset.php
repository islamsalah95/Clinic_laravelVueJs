<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Mail\VerifyPass;
use App\Traits\ApiTraits;
use App\Models\Admin\Admin;
use App\Models\Nurse\Nurse;
use Illuminate\Http\Request;
use App\Models\Doctor\Doctor;
use App\Traits\CustomHelpers;
use App\Models\Patient\Patient;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class Reset extends Controller
{
    public function reset(Request $request, $Auth)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);
        // dd($Auth);

        $Authenticatable= WhichUser::WhichUser($Auth);

        if (isset($Authenticatable)) {
            $user = $Authenticatable::where('email', $request->email)->first();
            if ($user) {
                $code=CustomHelpers::generateCode();
                $Authenticatable->where('email', $user->email)->update(['code' => $code]);
                Mail::to($user->email)->send(new VerifyPass($code));
                return ApiTraits::myData('code sent success'); 
        
            } else {
                return ApiTraits::error('login fail this email not in this role please make sure choses right role login', $user); 
            }


        }


    }
}
