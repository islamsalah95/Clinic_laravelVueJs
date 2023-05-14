<?php
namespace App\Traits;

trait ApiTraits
{
public static function myData(string $message="done",$data=[]){
return response()->json(
    [
        'data'=>$data,
        'message'=>$message,
    ]
    ,200);
}



public static function error(string $message="errors display please chick",$Errors=[]){
    return response()->json(
        [
            'data'=>$Errors,
            'message'=>$message,
        ]
        ,400);

}


// public static function data(array $data,string $message='done',int $statusCode=200){
//     return response()->json([
//         'success'=>true,
//         'message'=>$message,
//         'data'=>(object)$data,
//         'errors'=>(object)[],
//     ],$statusCode);
// }



}

