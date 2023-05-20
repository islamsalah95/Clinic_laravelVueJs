<?php

namespace App\Http\Resources;

use App\Http\Resources\DoctorResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id"=> $this->id,
            "department"=> $this->department,
            "department_doctors"=>DoctorResource::collection($this->Doctor),
        ];   
    
    }
}
