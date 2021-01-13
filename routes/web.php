<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

///////Admin//////

// For Change Language
Route::get('change-language/{locale}', [App\Http\Controllers\GeneralController::class,'changeLanguage'])->name('frontend_change_locale');


Route::get('/', [App\Http\Controllers\Admin\LoginController::class, 'redirectUserToController']);

Route::get('admin/home', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.home');
Route::get('admin', [App\Http\Controllers\Admin\LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin', [App\Http\Controllers\Admin\LoginController::class,'login']);
Route::get('admin/logout', [App\Http\Controllers\Admin\AdminController::class, 'Logout'])->name('admin.logout');


///Patient

Route::get('admin/patient', [\App\Http\Controllers\Admin\PatientController::class, 'getPatient'])->name('admin.home');
Route::post('admin/patient/store',[App\Http\Controllers\Admin\PatientController::class, 'storePatient'] )->name('patient.store');
Route::post('admin/patient/delete/{id}',[App\Http\Controllers\Admin\PatientController::class, 'deletePatient'])->name('admin.patient.delete');
Route::get('admin/patient/edit/{id}',[App\Http\Controllers\Admin\PatientController::class, 'editPatient'])->name('admin.patient.edit');
Route::post('admin/patient/update/{id}',[App\Http\Controllers\Admin\PatientController::class, 'updatePatient'] )->name('patient.update');

Route::get('admin/patient-file', [\App\Http\Controllers\Admin\PatientFileController::class, 'getPatientFile'])->name('admin.patient.file');
Route::post('admin/patient-file/store',[App\Http\Controllers\Admin\PatientFileController::class, 'storePatientFile'] )->name('patient.file.store');
Route::post('admin/patient-file/delete/{id}',[App\Http\Controllers\Admin\PatientFileController::class, 'deletePatientFile'])->name('admin.patient.file.delete');
Route::get('admin/patient-file/edit/{id}',[App\Http\Controllers\Admin\PatientFileController::class, 'editPatientFile'])->name('admin.patient.file.edit');
Route::post('admin/patient-file/update/{id}',[App\Http\Controllers\Admin\PatientFileController::class, 'updatePatientFile'] )->name('patient.file.update');



//// Gallary
Route::get('admin/gallary', [App\Http\Controllers\Admin\SliderController::class, 'gallaries'])->name('gallaries');
Route::post('admin/gallery/store',[App\Http\Controllers\Admin\SliderController::class, 'storeGallery'])->name('gallery.store');
Route::post('admin/gallery/delete/{id}', [App\Http\Controllers\Admin\SliderController::class, 'deleteGallery'])->name('admin.delete.gallery');
Route::get('admin/gallery/edit/{id}',[App\Http\Controllers\Admin\SliderController::class, 'editGallery'])->name('gallery.edit');
Route::post('admin/gallery/update/{id}',[App\Http\Controllers\Admin\SliderController::class, 'updateGallery'])->name('gallery.update');


/////////// News
Route::get('admin/news', [\App\Http\Controllers\Admin\NewsController::class, 'getNews'])->name('news');
Route::post('admin/news/store',[App\Http\Controllers\Admin\NewsController::class, 'storeNews'] )->name('news.store');
Route::post('admin/news/delete/{id}',[App\Http\Controllers\Admin\NewsController::class, 'deleteNews'])->name('admin.news.delete');
Route::get('admin/news/edit/{id}',[App\Http\Controllers\Admin\NewsController::class, 'editNews'])->name('admin.news.edit');
Route::post('admin/news/update/{id}',[App\Http\Controllers\Admin\NewsController::class, 'updateNews'] )->name('news.update');


/////////// Staff
Route::get('admin/staff', [\App\Http\Controllers\Admin\StaffController::class, 'getStaff'])->name('staff');
Route::post('admin/staff/store',[App\Http\Controllers\Admin\StaffController::class, 'storeStaff'] )->name('staff.store');
Route::post('admin/staff/delete/{id}',[App\Http\Controllers\Admin\StaffController::class, 'deleteStaff'])->name('admin.staff.delete');
Route::get('admin/staff/edit/{id}',[App\Http\Controllers\Admin\StaffController::class, 'editStaff'])->name('admin.staff.edit');
Route::post('admin/staff/update/{id}',[App\Http\Controllers\Admin\StaffController::class, 'updateStaff'] )->name('staff.update');
