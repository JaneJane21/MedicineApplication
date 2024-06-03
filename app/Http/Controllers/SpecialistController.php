<?php

namespace App\Http\Controllers;

use App\Models\Specialist;
use Illuminate\Http\Request;

class SpecialistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specialists = Specialist::all();
        return response()->json($specialists,200);
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
            'fio'=>'required',
            'job'=>'required',
            'service_id'=>'required',
            'img'=>'required',
            'category_id'=>'required',
        ]);
        $path = $request->file('img')->store('public/img');
        $spec = new Specialist();
        $spec->fio = $request->fio;
        $spec->job = $request->job;
        $spec->category_id = $request->category_id;
        $spec->service_id = $request->service_id;
        $spec->img = '/storage/'.$path;
        $spec->save();
        return redirect()->back()->with('success','Сохранено');
    }

    /**
     * Display the specified resource.
     */
    public function show(Specialist $specialist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specialist $specialist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'fio'=>'required',
            'job'=>'required',
            'service_id'=>'required',
            'category_id'=>'required',
        ]);
        $spec = Specialist::query()->where('id',$id)->first();
        $spec->fio = $request->fio;
        $spec->job = $request->job;
        $spec->category_id = $request->category_id;
        $spec->service_id = $request->service_id;
        if($request->img){
            $path = $request->file('img')->store('public/img');
            $spec->img = '/storage/'.$path;
        }
        $spec->update();
        return redirect()->back()->with('success','Изменено');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialist $specialist,$id)
    {
        Specialist::find($id)->delete();
        return redirect()->back()->with('success','Удалено');
    }
}
