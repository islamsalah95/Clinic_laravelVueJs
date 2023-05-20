<?php

namespace App\Http\Resources;

use App\Models\Nurse\Nurse;
use App\Models\Service\Service;
use App\Http\Resources\DepartmentResources;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorInfoResource extends JsonResource
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
            "name"=> $this->name,
            "email"=> $this->email,
            "department_id"=> DepartmentResources::collection($this->department_id),
            "services"=> ServicesResource::collection($this->Service),
            "nurses"=> NurseResource::collection($this->Nurse),
        ];
     }
}

