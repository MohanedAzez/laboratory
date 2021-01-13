<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'patient_id',
        'file',
        'state',
    ];
}
