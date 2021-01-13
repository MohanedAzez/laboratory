<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\PatFile;
use Validator;
use App\Models\PatientFile;
use Illuminate\Http\Request;

class PatientFileAPI extends BaseController
{

    public function getPatFile($id) {

        $patient = PatientFile::join('patients', 'patient_id', 'patients.id')
                                ->select('patient_files.*', 'patients.name')
                                ->where('patient_id', $id)
                                ->orderby('patient_files.id', 'desc')->get();

        if (is_null($patient) ) {
            return $this->sendError('not found'  );
        }
        return $this->sendResponse(PatFile::collection($patient) ,'Files found successfully' );

    }

}
