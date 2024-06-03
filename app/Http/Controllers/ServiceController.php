<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::query()->with(['category'])->get();
        return response()->json($services,200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'price'=>'required',
            'img'=>'required',
            'category_id'=>'required',
        ]);
        $path = $request->file('img')->store('public/img');
        $service = new Service();
        $service->title = $request->title;
        $service->description = $request->description;
        $service->category_id = $request->category_id;
        $service->price = $request->price;
        $service->img = '/storage/'.$path;
        $service->save();
        return redirect()->back()->with('success','Сохранено');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'price'=>'required',
            'img'=>'required',
            'category_id'=>'required',
        ]);
        $service = Service::query()->where('id',$id)->first();
        $service->title = $request->title;
        $service->description = $request->description;
        $service->category_id = $request->category_id;
        $service->price = $request->price;
        if($request->img){
            $path = $request->file('img')->store('public/img');
            $service->img = '/storage/'.$path;
        }
        $service->update();
        return redirect()->back()->with('success','Изменено');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service,$id)
    {
        Service::find($id)->delete();
        return redirect()->back()->with('success','Удалено');
    }
}
