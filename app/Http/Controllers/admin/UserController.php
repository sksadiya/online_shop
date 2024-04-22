<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
   public function index(Request $request) {
    
    $users = User::latest();
    if (!empty($request->get('search'))) {
        $users = $users->where('name', 'like', '%' . $request->get('search') . '%');
        $users = $users->where('email', 'like', '%' . $request->get('search') . '%');
    }
    $users = $users->paginate(10);
    return view('admin.users.list',compact('users'));
   }

   public function create() {
    return view('admin.users.create');
   }
   public function store(Request $request) {
    $validator = Validator::make($request->all() ,[
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'phone' => 'required|digits:10',
        'password' => 'required|min:6',
    ]) ;

    if($validator->passes()) {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();

        session()->flash('success','User created successfully');
        return response()->json([
            'status' => true,
            'message' => 'User created successfully'
        ]);
    } else {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ]);
    }
   }
   public function edit($id) {
    $user = User::find($id);
        if (empty($user)) {
        session()->flash('error','user not found');
        return redirect()->route('users.index');
        }
    return view('admin.users.edit',compact('user'));
   }
   public function update(Request $request,$id) {
    $user = User::find($id);
    if($user == null) {
        session()->flash('error','user not found');
        return response()->json([
            'status' =>false,
            'message' => 'user not found',
            'notFound' => true
        ]);
    }
    $userId = $user->id;
    $validator = Validator::make($request->all() ,[
        'name' => 'required',
        'email' => 'required|email|unique:users,email,'.$userId.'id',
        'phone' => 'required|digits:10',
    ]) ;

    if($validator->passes() ) {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if($request->password != '') {
        $user->password = $request->password;
        }
        $user->save();
        session()->flash('success','user updated successfully');
        return response()->json([
            'status' => true,
            'message' => 'user updated successfully'
        ]);
    } else {
        return response()->json([
            'status' =>false,
            'errors' => $validator->errors()
        ]);
    }
   }

  public function destroy(Request $request, $id)
   {
       $user = User::find($id);
       if (empty ($user)) {
           $request->session()->flash('error', 'user not found');

           return response()->json([
               'status' => false,
               'notFound' => true
           ]);
       }
       

       $user->delete();
       $request->session()->flash('success', 'user deleted successfully');
       return response()->json([
           'status' => true,
           'message' => 'user deleted successfully'
       ]);
   }
}
