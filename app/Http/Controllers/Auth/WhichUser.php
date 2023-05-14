<?php
namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Traits\ApiTraits;
use App\Models\Admin\Admin;
use App\Models\Nurse\Nurse;
use App\Models\Doctor\Doctor;
use App\Models\Patient\Patient;
/**
 * 
 */
trait WhichUser
{
    public static function WhichUser($Auth){

        if ($Auth == 'User') {
            $Authenticatable = new User();
            return  $Authenticatable ;
        } elseif ($Auth == 'Admin') {
            $Authenticatable = new Admin();
            return  $Authenticatable ;

        } elseif ($Auth == 'Doctor') {
            $Authenticatable = new Doctor();
            return  $Authenticatable ;

        } elseif ($Auth == 'Nurse') {
            $Authenticatable = new Nurse();
        } elseif ($Auth == 'Patient') {
            $Authenticatable = new Patient();
            return  $Authenticatable ;

        } else {
            return ApiTraits::error('pass wrong role user');
        }


    }
}



?>