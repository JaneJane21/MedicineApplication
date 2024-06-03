<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function auth(Request $request){
        $valid = Validator::make($request->all(),[
            'login'=>['required'],
            'password'=>['required'],
        ]);
        if($valid->fails()){
            return response()->json($valid->errors(),400);
        }
        $user = User::query()->where('login',$request->login)->where('password',md5($request->password))->first();
        if($user){
            Auth::login($user);
            return redirect()->route('application');
        }
        else{
            return response()->json('Пользователь не найден',404);
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
