<?php

namespace App\Http\Controllers\Auth;

use App\Traits\ApiTraits;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Logout extends Controller
{

    public function logout(){
        
        $user=Auth::guard('sanctum')->user();
        $user->tokens()->delete();
        return ApiTraits::myData(" logout success");
    }



}
