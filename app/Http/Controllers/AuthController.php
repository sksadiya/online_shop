<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function login() {
        return  view('account.login');
    }
    public function register() {
        return view('account.register');
    }
    public function processRegister(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        if($validator->passes()) {
            $user = new  User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->save();

            session()->flash('success','you have been registered successfully');
            return response()->json([
                'status' => true,
                'message'=> "Account created successfully"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' =>$validator->errors()
            ]);
        }
    }
}
