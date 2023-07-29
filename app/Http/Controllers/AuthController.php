<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'name'  =>'required|string',
            'password'  =>'required|confirmed',
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',

        ]);
        
        if($validator->fails()){
            return $validator->errors();
        }

                
        $dob = new Carbon();
        $dob->setDay($request->day);
        $dob->setYear($request->year);
        $dob->setMonth($request->month);
       
        $user = new User(); 
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->date_of_birth = $dob;
        
        if(is_numeric($request->emailphone)){
        
        $validatormobile = Validator::make($request->all(), [ 
        
                'emailphone' =>'required|regex:/\d{10}/|unique:users,mobile', 
        ]);

            if ($validatormobile->fails()) { 

                return response()->json([ 'error'=> $validatormobile->errors() ]);
          }

               $user->mobile  = $request->emailphone;
        }
        else {
            $validatoremail = Validator::make($request->all(), [ 
                'emailphone' =>'required|email|unique:users,email', 
            ]);
          
            if ($validatoremail->fails()) { 
                return response()->json([ 'error'=> $validatoremail->errors() ]);
          }
            $user->email = $request->emailphone;

        }

        $user->save();
        $token = $user->createToken('latyusDev')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token

        ];

        return $response;
    }

    // login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'emailphone' => 'required',
            'password' => 'required'
        ]);
        
        if($validator->fails()){

            return $validator->errors();
        }
        $user_details = [
            'emailphone' => $request->emailphone,
            'password' => $request->password
        ];

        $user = User::where('mobile', $request->emailphone)
                    ->orWhere('email', $request->emailphone)
                    ->first();

       if(!$user || !Hash::check($user_details['password'], $user->password) ){
                    
           return response(['meassage' => 'User not found']);

         }
        $token = $user->createToken('latyusDev')->plainTextToken;
                
        $response = [
                    'user' => $user,
                    'token' => $token
            ];

          return response($response, 201);
            

        }

        public function logout()
        {
            auth()->user()->tokens()->delete();

            return response(['message' => 'You are logged out']);
        }
}
