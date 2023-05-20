<?php
namespace App\Traits;

use App\Traits\ApiTraits;
use Illuminate\Http\Request;

trait CustomHelpers{


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


public static function saveFile($file, $path)
{
    $filename =CustomHelpers::generateCode(4).'.'.$file->getClientOriginalName();
  
    $filePath = public_path($path . '/' . $filename);
 
    $file->move(public_path($path), $filename);
    return asset($path . '/' . $filename);

    // if (file_exists($filePath)) {
    //     return asset($path . '/' . $filename);
    // } else {
    //     $file->move(public_path($path), $filename);
    //     return asset($path . '/' . $filename);
    // }
}


public static function deleteFile($fileName,$Folder)
{

    $filePath = basename($fileName);
    $filePath = $Folder . "\\" . $filePath;
    $publicPath = public_path($filePath);
    if (file_exists($publicPath)) {
        unlink($publicPath);
    } 
}


}