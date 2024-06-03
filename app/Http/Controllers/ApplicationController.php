<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $app = Application::all();
        return response()->json($app,200);
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
        $valid = Validator::make($request->all(),[
            'fio'=>['required'],
            'phone'=>['required','digits:11'],
            'description'=>['required'],
        ]);
        if($valid->fails()){
            return response()->json($valid->errors(),400);
        }
        $app = new Application();
        $app->fio = $request->fio;
        $app->phone = $request->phone;
        $app->description = $request->description;
        $app->save();
        return response()->json([],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        // dd($request->all());
        $valid = Validator::make($request->all(),[
            'comment'=>['required'],
        ]);
        if($valid->fails()){
            return response()->json($valid->errors(),400);
        }
        $app = Application::query()->where('id',$request->id)->first();
        $app->status = 'отмененная';
        $app->comment = $request->comment;
        $app->update();
        return response()->json([],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        $valid = Validator::make($request->all(),[
            'specialist_id'=>['required'],
            'date'=>['required'],
            'time'=>['required'],
        ]);
        if($valid->fails()){
            return response()->json($valid->errors(),400);
        }
        $sched = Schedule::query()->
        where('specialist_id',$request->specialist_id)->
        where('date',$request->date)->
        where('time',$request->time)->first();
        if($sched){
            return response()->json('На данную дату и время уже есть запись',404);
        }
        else{
            $s = new Schedule();
            $s->specialist_id = $request->specialist_id;
            $s->application_id = $request->id;
            $s->date = $request->date;
            $s->time = $request->time;
            $s->save();
            $app = Application::query()->where('id',$request->id)->first();
            $app->status = 'подтвержденная';
            $app->update();
            return response()->json([],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        //
    }
}
