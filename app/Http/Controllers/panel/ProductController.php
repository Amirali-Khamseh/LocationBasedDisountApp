<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
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
         $data = Product::with('category','image','owner')->select('id','title','category_id','status','owner_id','price','discount_percent')->get();
    
        return view('panel.products.index',compact('data'));
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
        $data['parent_categories'] = Category::where('parent_id', 0)->get();
        return view('panel.products.create',compact('data'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3',
            'childern_id' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'discount_percent' => 'nullable|digits_between:0,100'
        ]);

        $data = Product::create([
            'title' => $request->title,
            'status' => $request->status == 'on' ? 1 : 0,
            'is_slider' => $request->is_slider == 'on' ? 1 : 0,
            'owner_id' => auth()->user()->id,
            'category_id' => $request->childern_id,
            'description' => $request->description,
            'product_link' => $request->product_link,
            'price' => $request->price,
            'discount_percent' => isset($request->discount_percent) ? $request->discount_percent : 0
        ]);
        if (isset($data)) {
            $name = $request->file('image')->getClientOriginalName();

            $path = $request->file('image')->store('public/images');

            $save = new Photo;

            $save->name = $name;
            $save->path = $path;
            $save->product_id = $data->id;
            $save->save();
        }
        
        if($data){
            return redirect()->back()->with(['error' => 0, 'msg' => 'product created succesfully']);
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
        $data['data'] = Product::with('category','image')->find($id);
        $data['parent_categories'] = Category::where('parent_id', 0)->get();
        return view('panel.products.edit',compact('data'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|min:3',
            'childern_id' => 'required',
           // 'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'discount_percent' => 'nullable|digits_between:0,100'
        ]);
        $data = Product::find($id)->update([
            'title' => $request->title,
            'status' => $request->status == 'on' ? 1 : 0,
            'is_slider' => $request->is_slider == 'on' ? 1 : 0,
            //'owner_id' => auth()->user()->id,
            'product_link' => $request->product_link,
            'category_id' => $request->childern_id,
            'description' => $request->description,
            'price' => $request->price,
            'discount_percent' => isset($request->discount_percent) ? $request->discount_percent : 0
        ]);
        //if request image exists
        if ($request->has('image')) {
            $name = $request->file('image')->getClientOriginalName();

            $path = $request->file('image')->store('public/images');

            $save = new Photo;

            $save->name = $name;
            $save->path = $path;
            $save->product_id = $id;
            $save->save();
        }
    
        if($data){
            return redirect()->back()->with(['error' => 0, 'msg' => 'Data Modified sucessfully']);
    }else{
          return redirect()->back()->with(['error' => 1, 'msg' => '😑Something Went wrong!!! , try again']);
      }
    }
    public function destroy($id)
    {
        Product::find($id)->delete();
        //redirecting to the page after deleting the record 
        return redirect()->back();
    }
    public function productDestory($id){
        $data = Photo::where('product_id',$id)->first();
        Storage::delete($data->path);
        $data->delete();
        return redirect()->back();
    }

    public function GetComment($id){
        
        if (!Auth::check()) {
            abort(403);
        }else{
            if (Auth::user()->role_id != 1) {
                abort(403);
            }
        }
       
         $data  = Comment::with('user')->where('product_id',$id)->select('id','user_id','product_id','description','status','rating')->get();
        
        return view('panel.products.comments',compact('data'));
    }
    public function PostComment($id){
        

        $data  = Comment::with('user')->where('id',$id)->select('id','user_id','product_id','description','status','rating')->first();
        
        $data->status = !$data->status;
        $data->save();
        $product  = Product::find($data->product_id);
        $comments = Comment::where("status",1)->where("product_id",$product->id)->get();
        $average_rating = 0;
        $sum = 0;
        $count  = 0 ; 
        foreach($comments as $item ){
            $sum = $sum + $item->rating;
            $count++;
        }
        $average_rating= $sum / $count ; 
        $product->avg_rate = $average_rating; 
        $product->save(); 
        return redirect()->back();
    }
}
