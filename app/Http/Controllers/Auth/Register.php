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
use Illuminate\Support\Facades\Hash;

class Register extends Controller
{
    public function create(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:patients'],
            'age' => ['required', 'integer', 'max:100'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $Authenticatable = new Patient();
        
            if (isset($Authenticatable)) {
            $password = bcrypt($request->password); 
            $user = Patient::create(array_merge($request->all(), ['password' => $password])); 
            $tokens = $user->createToken('Android')->plainTextToken;
            $user->token = 'Bearer ' . $tokens;       
            return ApiTraits::myData('Register success',$user); 

        }
    }




}