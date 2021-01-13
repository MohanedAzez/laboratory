<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\PatientFile;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function gallaries() {
        $gallaries = Slider::select()->orderBy('id', 'desc')->paginate(20);
        return view('admin.gallery.gallaries', compact('gallaries'));
    }

    public function storeGallery(Request $request) {

        $validation = Validator::make($request->all(), [
            'picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        if($validation -> fails()) {
            return redirect()->back()->withErrors($validation)->withInput($request->all());
        }
        $file = $request->file('picture');
        $fileName = '';
        if ($file) {
            $image_name = date('dmy_H_s_i'.rand());
            $ext = strtolower($file->getClientOriginalExtension());

            $upload_path = 'assets/file/image/gallery/';


            $image_full_name = $image_name.'.'.$ext;
            $image_url = $upload_path.$image_full_name;
            $file->move($upload_path,$image_full_name);

            $fileName = $image_url;
        }


        $store = Slider::create([
            'picture' => $fileName,
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

    public function deleteGallery($id) {

        $PicDelete = Slider::find($id); // search in data base with id only

        if (!$PicDelete)
            return redirect()->back();


        //For Delete File
        $data2 = DB::table('sliders')->where('id',$id)->first();
        $file = $data2->picture;
        if ($file != "") {
            unlink($file);
        }

        //For Delete Patient-File
        $deletePic = $PicDelete->delete();

        if ($deletePic) {
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


    public function editGallery($id) {

        $editIdPic = Slider::find($id);
        if (!$editIdPic)
            return redirect()->back();
        $pic = Slider::select()->where('id', $id)->first();

        return view('admin.gallery.edit-gallery', compact('pic'));

    }


    public function updateGallery(Request $request, $id) {

        $editIdPic = Slider::find($id);
        if (!$editIdPic)
            return redirect()->back();

        $validation = Validator::make($request->all(), [
            'picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        if($validation -> fails()) {
            return redirect()->back()->withErrors($validation)->withInput($request->all());
        }

        $fileName = '';
        $file = $request->file('picture');
        $old_file = $request->old_pic;

        if ($file) {
            $image_name = date('dmy_H_s_i'.rand());
            $ext = strtolower($file->getClientOriginalExtension());

            $upload_path = 'assets/file/image/gallery/';

            $image_full_name = $image_name.'.'.$ext;
            $image_url = $upload_path.$image_full_name;
            $file->move($upload_path,$image_full_name);

            $fileName = $image_url;

            if ($old_file != '') {
                unlink($old_file); // Delete Old File
            }

        }

        $updatePic = $editIdPic->update([
            'picture' => $fileName,
        ]);

        if ($updatePic) {

            $notification = array(
                'message' => __('site.messageUpdate'),
                'alert-type' => 'success'
            );
            return Redirect()->route('gallaries')->with($notification);
        }else{
            $notification = array(
                'message' => __('site.failed'),
                'alert-type' => 'error'
            );
            return Redirect()->route('gallaries')->with($notification);
        }

    }
}
