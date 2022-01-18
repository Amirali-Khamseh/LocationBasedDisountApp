<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            abort(403);
        }else{
            if (Auth::user()->role_id != 1) {
                abort(403);
            }
        }
        //getting all the users
        $users = User::with('role')->get();
        // sending them to client side 
        return view('panel.users.index',compact('users'));
    }
    public function create()
    {
        if (!Auth::check()) {
            abort(403);
        }else{
            if (Auth::user()->role_id != 1) {
                abort(403);
            }
        }
        $roles = Role::get();
        return view('panel.users.create', compact('roles'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:20',
            'family' => 'required|min:3|max:20',
            'mobile' => 'required|numeric',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);
        
        $user = User::create([
            'role_id' => $request->role,
            'name' => $request->name,
            'family' => $request->family,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'status' => $request->status == 'on' ? 1 : 0,
            'password' => Hash::make($request->password)
        ]);
        if($user){
            return redirect()->back()->with(['error' => 0, 'msg' => 'user created succesfully']);
        }else{
            return redirect()->back()->with(['error' => 1, 'msg' => '😑Something Went wrong!!! , try again']);
        }
    }
    public function show($id)
    {
    //
    }
    public function edit($id)
    {
        if (!Auth::check()) {
            abort(403);
        }else{
            if (Auth::user()->role_id != 1) {
                abort(403);
            }
        }
        //getting  the user with specific id  
         $user = User::where('id',$id)->first();
         //sending back all the roles to the client side 
         $roles = Role::get();
         //sending them to the client side 
        return view('panel.users.edit',compact('user'),compact('roles'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:20',
            'family' => 'required|min:3|max:20',
            'mobile' => 'required|numeric',
            'email' => 'required|email',
            'password' => 'nullable|confirmed|min:6',
        ]);
        //finds the first one with this id 
    $newUser  = User::find($id)->update([
        'name' => $request->name,
        'family' => $request->family,
        'email' => $request->email,
        'mobile' => $request->mobile,
        'role_id' => $request->role,
        'status' => isset($request->status) && $request->status == 'on' ? 1 : 0,
        'password' => Hash::make($request->password)
   ]);
   if($newUser){
               return redirect()->back()->with(['error' => 0, 'msg' => 'Data Modified sucessfully']);
       }else{
             return redirect()->back()->with(['error' => 1, 'msg' => '😑Something Went wrong!!! , try again']);
         }
    }
    public function destroy($id)
    {
        
        //deleting the given user based on its id 
        User::find($id)->delete();
        //redirecting to the page after deleting the record 
        return redirect()->back();
    }
}
