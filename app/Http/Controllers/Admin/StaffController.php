<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function getStaff() {
        $staff = Staff::select()->orderBy('id', 'desc')->paginate(20);
        return view('admin.staff.staff', compact('staff'));
    }


    public function storeStaff(Request  $request) {

        $validation = Validator::make($request->all(), [
            'name' => 'required|max:190',
            'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'spec' => 'required',
        ]);


        if($validation -> fails()) {
            return redirect()->back()->withErrors($validation)->withInput($request->all());
        }

        $image = $request->file('img');
        $img1 = '';

        if ($image) {
            $image_name = date('dmy_H_s_i'.rand());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'assets/file/image/staff/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path,$image_full_name);
            $img1 = $image_url;
        }

        $store = Staff::create([
            'name' => $request->name,
            'picture' => $img1,
            'specialization' => $request->spec,
        ]);

        if ($store) {

            $notification = array(
                'message' => __('site.messageAdded'),
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => __('site.failed'),
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }

    }


    public function deleteStaff($id) {

        $staffDelete = Staff::find($id); // search in data base with id only

        if (!$staffDelete)
            return redirect()->back();

        //For Delete File
        $data2 = DB::table('staff')->where('id',$id)->first();
        $file = $data2->picture;
        if ($file != "") {
            unlink($file);
        }

        //For Delete Patient-File
        $deleteNews = $staffDelete->delete();

        if ($deleteNews) {
            $notification = array(
                'message' => __('site.messageDelete'),
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => __('site.failed'),
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }


    public function editStaff($id) {

        $editIdStaff = Staff::find($id);
        if (!$editIdStaff)
            return redirect()->back();
        $staff = Staff::select()->where('id', $id)->first();

        return view('admin.staff.edit-staff', compact('staff'));
    }


    public function updateStaff($id, Request $request) {
        $editIdStaff = Staff::find($id);
        if (!$editIdStaff)
            return redirect()->back();

        $validation = Validator::make($request->all(), [
            'name' => 'required|max:190',
            'img' => 'image|mimes:jpeg,png,jpg|max:2048',
            'spec' => 'required',
        ]);


        if($validation -> fails()) {
            return redirect()->back()->withErrors($validation)->withInput($request->all());
        }

        $fileName = '';
        $file = $request->file('img');
        $old_file = $request->old_pic;

        if ($file) {
            $image_name = date('dmy_H_s_i'.rand());
            $ext = strtolower($file->getClientOriginalExtension());
            $upload_path = 'assets/file/image/staff/';

            $image_full_name = $image_name.'.'.$ext;
            $image_url = $upload_path.$image_full_name;
            $file->move($upload_path,$image_full_name);

            $fileName = $image_url;

            if ($old_file != '') {
                unlink($old_file); // Delete Old File
            }

        }else {
            $fileName = $old_file;
        }

        $updateStaff = $editIdStaff->update([
            'name' => $request->name,
            'picture' => $fileName,
            'specialization' => $request->spec,
        ]);

        if ($updateStaff) {

            $notification = array(
                'message' => __('site.messageUpdate'),
                'alert-type' => 'success'
            );
            return Redirect()->route('staff')->with($notification);
        }else{
            $notification = array(
                'message' => __('site.failed'),
                'alert-type' => 'error'
            );
            return Redirect()->route('staff')->with($notification);
        }
    }
}
