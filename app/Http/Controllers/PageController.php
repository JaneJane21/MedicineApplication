<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use App\Models\Specialist;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function welcome(){
        $specialists = Specialist::query()->limit(4)->get();
        return view('welcome',['specialists'=>$specialists]);
    }
    public function catalog(){
        return view('guest.catalog',['link_filter'=>'']);
    }
    public function catalog_filter($id){
        // dd($id);
        return view('guest.catalog',['link_filter'=>$id]);
    }
    public function detail($id){
        // dd($id);
        $service = Service::query()->where('id',$id)->first();
        $specialists = Specialist::query()->where('service_id',$service->id)->get();
        return view('guest.detail',['service'=>$service,'specialists'=>$specialists]);
    }
    public function login(){
        return view('guest.auth');
    }
    public function category(){
        $categories = Category::all();
        return view('admin.category',['categories'=>$categories]);
    }
    public function service(){
        $categories = Category::all();
        $services = Service::all();
        return view('admin.service',['categories'=>$categories,'services'=>$services]);
    }

    public function specialist(){
        $categories = Category::all();
        $services = Service::all();
        $specialists = Specialist::all();
        return view('admin.specialist',['categories'=>$categories,'services'=>$services,'specialists'=>$specialists]);
    }
    public function specialists(){
        return view('guest.specialists');
    }
    public function contact(){
        return view('guest.contact');
    }
    public function new_app(){
        return view('guest.add_app');
    }
    public function application(){
        return view('admin.application');
    }
}
