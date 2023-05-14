<?php
namespace App\Traits;

use App\Traits\ApiTraits;
use Illuminate\Http\Request;

trait CustomHelpers{

    public static function uploadImg($request,$img,$path){

    if ($request->hasFile($img)) {
    $fileName=$request->file($img)->getClientOriginalName();
     $request->file($img)->move(public_path($path),$fileName);
     $pathImg = asset($path.$fileName) ;//http://127.0.0.1:8000/assets/images/test.jpg
     return $pathImg;
    }else{
        ApiTraits::errorMessage('img is empty');
    }
    }


    public static function uploadImgNull(Request $request,$img,$path){
     if($request->file($img)){
        $fileName=$request->file($img)->getClientOriginalName();
        if ($request->hasFile($img)) {
         $request->file($img)->move(public_path('assets\images'),$fileName);
         $pathImg = asset($path.$fileName) ;//http://127.0.0.1:8000/assets/images/test.jpg

         return $pathImg;
        }
     }else{
        return "";
     }
        }


        public static  function generateCode($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

public static  function getHour($num) {
    $current_hour = date('h'); // Get current hour in 12-hour format
    $current_am_pm = date('a'); // Get AM/PM indicator for current time
    $plus_hours = strtotime("+$num hour"); // Add one hour to current time
    $plus_hours_12h = date('h', $plus_hours); // Convert the added hour to 12-hour format
    $plus_hours_am_pm = date('a', $plus_hours); // Get AM/PM indicator for the added hour
    return $plus_hours_12h . $plus_hours_am_pm; // Output the added hour in 12-hour format with AM/PM indicator
}


public static  function avilableWeekDays() {
    $days=[];
// Set the timezone
date_default_timezone_set('Africa/Cairo');

// Get tomorrow's date
$tomorrow = strtotime('tomorrow');

// Loop through all days of the week starting from tomorrow
for ($i = 0; $i < 7; $i++) {
    // Calculate the date for the current day
    $currentDay = strtotime("+$i day", $tomorrow);
    
    // Display the day of the week and date
    // echo date('l, F j, Y', $currentDay) . "<br>";
    $days[]= date('l', $currentDay);
   
    
}
      return $days;
}
















}
