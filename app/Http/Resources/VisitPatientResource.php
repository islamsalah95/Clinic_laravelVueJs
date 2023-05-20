<?php

namespace App\Http\Resources;

use App\Models\Doctor\Doctor;
use App\Models\Patient\Patient;
use App\Http\Resources\PatientResource;
use App\Http\Resources\DoctorInfoResource;
use Illuminate\Http\Resources\Json\JsonResource;

class VisitPatientResource extends JsonResource
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
            "doctor"=>new DoctorResource($this->Doctor),
            "patient"=>new PatientResource(Patient::find($this->patient_id)),
            "day"=> $this->day,
            "hour"=> $this->hour,
            "created_at"=> $this->created_at,
            "phone"=> $this->phone,

        ];   
     }
}
