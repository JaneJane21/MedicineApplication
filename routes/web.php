<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\UserController;
use App\Models\Application;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[PageController::class,'welcome'])->name('welcome');

Route::get('/nav',[CategoryController::class,'index'])->name('get_nav_categories');

Route::get('/auth',[PageController::class,'login'])->name('login');
Route::post('/auth/send',[UserController::class,'auth'])->name('auth');
Route::get('/user/logout',[UserController::class,'logout'])->name('logout');

Route::get('/category',[PageController::class,'category'])->name('category');
Route::post('/category/new',[CategoryController::class,'store'])->name('save_category');
Route::get('/category/delete/{id?}',[CategoryController::class,'destroy'])->name('destroy_category');
Route::post('/category/edit/{id?}',[CategoryController::class,'update'])->name('edit_category');

Route::get('/service',[PageController::class,'service'])->name('service');

Route::post('/service/new',[ServiceController::class,'store'])->name('save_service');
Route::get('/service/delete/{id?}',[ServiceController::class,'destroy'])->name('destroy_service');
Route::post('/service/edit/{id?}',[ServiceController::class,'update'])->name('edit_service');

Route::get('/specialist',[PageController::class,'specialist'])->name('specialist');
Route::post('/specialist/new',[SpecialistController::class,'store'])->name('save_specialist');
Route::get('/specialist/delete/{id?}',[SpecialistController::class,'destroy'])->name('destroy_specialist');
Route::post('/specialist/edit/{id?}',[SpecialistController::class,'update'])->name('edit_specialist');

Route::get('/application',[PageController::class,'application'])->name('application');
Route::get('/application/get',[ApplicationController::class,'index'])->name('get_applications');
Route::get('/application/specialists/get',[SpecialistController::class,'index'])->name('get_specialists_for_app');
Route::post('/application/cancel',[ApplicationController::class,'edit'])->name('cancel_application');
Route::post('/application/confirm',[ApplicationController::class,'update'])->name('confirm_application');

Route::get('/catalog/',[PageController::class,'catalog'])->name('catalog');
Route::get('/catalog/filter/{id?}',[PageController::class,'catalog_filter'])->name('catalog_filter');
Route::get('/catalog/services',[ServiceController::class,'index'])->name('get_services');
Route::get('/catalog/categories',[CategoryController::class,'index'])->name('get_categories');

Route::get('/detail/{id?}',[PageController::class,'detail'])->name('detail');

Route::get('/specialists',[PageController::class,'specialists'])->name('specialists');
Route::get('/specialists/get',[SpecialistController::class,'index'])->name('get_specialists');
Route::get('/specialists/services/get',[ServiceController::class,'index'])->name('get_services_for_spec');

Route::get('/contact',[PageController::class,'contact'])->name('contact');

Route::get('/new_application',[PageController::class,'new_app'])->name('new_app');
Route::post('/new_application/send',[ApplicationController::class,'store'])->name('store_new_app');
