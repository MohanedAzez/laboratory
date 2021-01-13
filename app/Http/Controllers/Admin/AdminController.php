<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }



    public function index() {
        $patient = Patient::select()->orderBy('id', 'desc')->paginate(20);
        return view('admin.patient.home', compact('patient'));

    }


    public function Logout() {
        Auth::logout();

        $notification = array(
            'message' => 'Successfuly Logout',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.login')->with($notification);
    }

}
