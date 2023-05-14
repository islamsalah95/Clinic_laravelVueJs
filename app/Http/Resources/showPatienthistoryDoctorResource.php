<?php

namespace App\Http\Resources;

use App\Models\Visit\Visit;
use App\Models\Doctor\Doctor;
use App\Models\Patient\Patient;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\ServicesResource;
use App\Models\Patienthistory\Patienthistory;
use Illuminate\Http\Resources\Json\JsonResource;

class showPatienthistoryDoctorResource extends JsonResource
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
            "doctor"=>new DoctorResource($this->Doctor),
            "patient"=> new PatientResource($this->Patient),
            "visit"=> new VisitResource($this->Visit),
            "services"=> ServicesResource::collection($this->Service),
            "medcine_notice"=> $this->medcine_notice,
            "created_at"=> $this->created_at,
        ];
    }
}
