<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    public function index()
    {
        // return $data = Category::with('parent')->get();
        // return $data = Category::with('childs')->get();
        if (!Auth::check()) {
            abort(403);
        }else{
            if (Auth::user()->role_id != 1) {
                abort(403);
            }
        }
        $data = Category::with('parent')->get();
        return view('panel.categories.index',compact('data'));
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
        $categories = Category::where('parent_id', 0)->get();
        return view('panel.categories.create',compact('categories'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:20',
            'parent_id' => 'required',
        ]);
        $data = Category::create([
            'title' => $request->title,
            'parent_id' => $request->parent_id,
            'status' => $request->status == 'on' ? 1 : 0
        ]);
        if($data){
            return redirect()->back()->with(['error' => 0, 'msg' => 'category created succesfully']);
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
        $cat = Category::where('id',$id)->first();
        $data = Category::where('parent_id',0)->with('parent')->get();
        return view('panel.categories.edit',compact(['cat','data']));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:20',
            'parent_id' => 'required',
        ]);
        $data = Category::find($id)->update([
            'title' => $request->title,
            'parent_id' => $request->parent_id,
            'status' => $request->status == 'on' ? 1 : 0
        ]);
        if($data){
            return redirect()->back()->with(['error' => 0, 'msg' => 'Data Modified sucessfully']);
    }else{
          return redirect()->back()->with(['error' => 1, 'msg' => '😑Something Went wrong!!! , try again']);
      }
    }
    public function destroy($id)
    {
        Category::find($id)->delete();
        //redirecting to the page after deleting the record 
        return redirect()->back();
    }
}
