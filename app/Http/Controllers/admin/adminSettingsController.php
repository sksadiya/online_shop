<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
class adminSettingsController extends Controller
{
   public function showChangePasswordForm() {
    return view('admin.settings.change');
   }
   public function changeAdminPasswordSettings(Request $request) {
    $validator = Validator::make($request->all() ,[
        'old_password' => 'required',
        'password' => 'required',
        //'password_confirmation' => 'required|min:6|confirmed',
    ]);
    $admin = User::where('id', Auth::guard('admin')->id())->first();
    if($validator->passes()) {
        if(!Hash::check($request->old_password ,$admin->password)) {
            return redirect()->route('settings.change')->with('error' , "old password is incorrect");
        }
        User::where('id',Auth::guard('admin')->id())->update([
            'password' => Hash::make($request->password)
        ]);
        return redirect()->route('settings.change')->with('success','password updated successfully');
      
    } else {
        return redirect()->route('settings.change')->withErrors($validator)->withInput();
    }
   
}
}
