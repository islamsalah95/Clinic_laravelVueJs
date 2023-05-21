<?php

namespace App\Http\Controllers\Doctor;

use App\Traits\ApiTraits;
use Illuminate\Http\Request;
use App\Traits\CustomHelpers;
use App\Notifications\PatientNotification;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Doctor\DoctorNotifications;
use App\Http\Requests\StoreDoctroNotificationsRequest;
use App\Models\Patient\Patient;
use Illuminate\Support\Facades\Notification;

class DoctorNotificationsController extends Controller
{
    public function store(Request $request)
    {
        $data=[
            "title"=>$request->title,
            "desc"=>$request->desc,
            "patient_id"=>$request->patient_id,
        ];

        // $result=DoctorNotifications::create($data);
        $userE=Patient::findOrFail($request->patient_id)->first();
         $userE->notify(new PatientNotification($data,$request->patient_id));
        return ApiTraits::myData('store DoctroNotifications success',$data); 
    }


    public function unreadNotifications()
    {
        $user = $this->AuthUser();
        $results=$user->unreadNotifications;
        return ApiTraits::myData('results unreadNotifications success',$results); 

    }


    public function readNotifications()
    {
        $user = $this->AuthUser();
 
        $results=$user->readNotifications;

        return ApiTraits::myData('results unreadNotifications success',$results); 


    }

    public function markAsRead()
    {
        $user = $this->AuthUser();
 
        $user->unreadNotifications->markAsRead();

        // foreach ($user->unreadNotifications as $notification) {
        //     $notification->markAsRead();
        // }

        return ApiTraits::myData('results unreadNotifications success'); 


    }

    public function deleteNotification()
    {
        $user = $this->AuthUser();
 

        $user->notifications()->delete();


        return ApiTraits::myData('results unreadNotifications  delete success'); 


    }


}
