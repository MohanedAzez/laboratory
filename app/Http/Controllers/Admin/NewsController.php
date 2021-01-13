<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function getNews() {
        $news = News::select()->orderBy('id', 'desc')->paginate(20);
        return view('admin.news.news', compact('news'));
    }


    public function storeNews(Request  $request) {

        $validation = Validator::make($request->all(), [
            'tittle_news' => 'required|max:190',
            'img_news' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'details_news' => 'required',
        ]);


        if($validation -> fails()) {
            return redirect()->back()->withErrors($validation)->withInput($request->all());
        }





        $image = $request->file('img_news');
        $img1 = '';

        if ($image) {
            $image_name = date('dmy_H_s_i'.rand());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'assets/file/image/news/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path,$image_full_name);
            $img1 = $image_url;
        }

        $store = News::create([
            'tittle' => $request->tittle_news,
            'picture' => $img1,
            'desc' => $request->details_news,
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


    public function deleteNews($id) {

        $newsDelete = News::find($id); // search in data base with id only

        if (!$newsDelete)
            return redirect()->back();

        //For Delete File
        $data2 = DB::table('news')->where('id',$id)->first();
        $file = $data2->picture;
        if ($file != "") {
            unlink($file);
        }

        //For Delete Patient-File
        $deleteNews = $newsDelete->delete();

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


    public function editNews($id) {

        $editIdNews = News::find($id);
        if (!$editIdNews)
            return redirect()->back();
        $news = News::select()->where('id', $id)->first();

        return view('admin.news.edit-news', compact('news'));
    }


    public function updateNews($id, Request $request) {
        $editIdNews = News::find($id);
        if (!$editIdNews)
            return redirect()->back();

        $validation = Validator::make($request->all(), [
            'tittle_news' => 'required|max:190',
            'img_news' => 'image|mimes:jpeg,png,jpg|max:2048',
            'details_news' => 'required',
        ]);


        if($validation -> fails()) {
            return redirect()->back()->withErrors($validation)->withInput($request->all());
        }

        $fileName = '';
        $file = $request->file('img_news');
        $old_file = $request->old_pic;

        if ($file) {
            $image_name = date('dmy_H_s_i'.rand());
            $ext = strtolower($file->getClientOriginalExtension());

            $upload_path = 'assets/file/image/news/';

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

        $updateNews = $editIdNews->update([
            'tittle' => $request->tittle_news,
            'picture' => $fileName,
            'desc' => $request->details_news,
        ]);

        if ($updateNews) {

            $notification = array(
                'message' => __('site.messageUpdate'),
                'alert-type' => 'success'
            );
            return Redirect()->route('news')->with($notification);
        }else{
            $notification = array(
                'message' => __('site.failed'),
                'alert-type' => 'error'
            );
            return Redirect()->route('news')->with($notification);
        }
    }
}
