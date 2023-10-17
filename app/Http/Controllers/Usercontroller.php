<?php

namespace App\Http\Controllers;

use App\Models\User;
use Attribute;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Usercontroller extends Controller
{
    public function login(Request $req){
        $rules = [
            "email" => 'required|email',
            "password"=>'required|min:8',
        ];

        $validator = Validator::make($req->all(),$rules);
        if ($validator->failed()) {
            return response()->json(['error'=>true,'message'=>$validator->errors()],200);
        }
        $info = User::select('id', 'name', 'email', 'country', 'BD')->get();
        return response()->json($info);

        //login 
        $cred = $req->only(['email', 'password']);
        $token = Auth::guard('api')->attempt($cred);
    
        if (!$token) 
            return response()->json(['error'=>true,'message'=>$validator->errors()],200);
        
        $users = Auth::guard('api')->user();
        return $this-> returnData('user',$users);
    }
    public function ByCountry(Request $req){
        $user= User::where("country",$req->country)->get();
        return response()->json($user, 200);
        
    }

    public function age(Request $req){
        $user= User::find($req -> BD);
        $dateOfBirth = new \DateTime($user);
        $today = new \DateTime('now');
        $interval = $today->diff($dateOfBirth);
        echo $interval->format("%y years %m months");
        }
        }
    
    
