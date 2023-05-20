<?php
namespace App\Http\Controllers\Patient;


use App\Models\User;
use App\Traits\ApiTraits;
use App\Models\Admin\Admin;
use App\Models\Nurse\Nurse;
use Illuminate\Http\Request;
use App\Models\Doctor\Doctor;
use App\Models\Patient\Patient;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\Register;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Http\Resources\PatientResource;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \App\Http\Requests\StorePatientRequest  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(StorePatientRequest $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Patient\Patient  $patient
    //  * @return \Illuminate\Http\Response
    //  */
    public function show()
    {
        $results=Patient::all();

        $results=PatientResource::collection($results);

        return ApiTraits::myData('Patienthistory store success', $results);

    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\Patient\Patient  $patient
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Patient $patient)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \App\Http\Requests\UpdatePatientRequest  $request
    //  * @param  \App\Models\Patient\Patient  $patient
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(UpdatePatientRequest $request, Patient $patient)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Patient\Patient  $patient
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Patient $patient)
    // {
    //     //
    // }
}
