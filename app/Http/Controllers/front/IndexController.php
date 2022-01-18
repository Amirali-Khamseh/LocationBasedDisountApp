<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Comment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Photo;
use \Illuminate\Database\Eloquent\Builder;

class IndexController extends Controller
{
    private function avg_comments($comments, $count){
        $avg = 0;
        foreach($comments as $item){
            $avg += $item->rating;
        }
        return $avg / $count;
    }
    public function index(){

        $data['categories'] = Category::with('childs')->where('status',1)->where('parent_id',0)->get();
        $data['slider'] = Product::with('image','category')->where(['status' => 1,'is_slider' => 1])->get();
        
        $user_id = Auth::check() ? Auth::user()->id : false;
        // return $data['product_new_deals'] = Product::with('image','category')->where(['status' => 1])->orderBy('updated_at','desc')->get()->take(10);
        
        $data['product_new_deals'] = Product::with('image','category')->where(['status' => 1])->orderBy('id','desc')->get()->take(10)->map(function ($query) use($user_id){
            if ($user_id == false) {
                $wishlist = 'is_not_login';
            }else{
                $data = Wishlist::where(['product_id' => $query->id, 'user_id' => $user_id])->first();
                $wishlist = isset($data) ? 1 : 0;
            }
            $comments = Comment::where(['product_id' => $query->id, 'status' => 1])->get();
            $count = count($comments);
            $avg_comments = count($comments) > 0 ? $this->avg_comments($comments,$count) : 0;
            return [
                'id' => $query->id,
                'title' => $query->title,
                'price' => $query->price,
                'discount_percent' => $query->discount_percent,
                'image' => isset($query->image) ? route('image-show') . '?image=' . $query->image->path : asset('images/no-img.jpg'),
                'category' => $query->category,
                'is_wishlist' => $wishlist,
                'updated_at' => $query->updated_at,
                'rating' => $avg_comments,
                'rating_count' => $count
            ];
        });

      $data['top_rating'] = Product::with('image','category')->where(['status' => 1])->orderBy('avg_rate','desc')->get()->take(10)->map(function ($query) use($user_id){
            if ($user_id == false) {
                $wishlist = 'is_not_login';
            }else{
                $data = Wishlist::where(['product_id' => $query->id, 'user_id' => $user_id])->first();
                $wishlist = isset($data) ? 1 : 0;
            }
            $comments = Comment::where(['product_id' => $query->id, 'status' => 1])->get();
            $count = count($comments);
            $avg_comments = count($comments) > 0 ? $this->avg_comments($comments,$count) : 0;
            return [
                'id' => $query->id,
                'title' => $query->title,
                'price' => $query->price,
                'discount_percent' => $query->discount_percent,
                'image' => isset($query->image) ? route('image-show') . '?image=' . $query->image->path : asset('images/no-img.jpg'),
                'category' => $query->category,
                'is_wishlist' => $wishlist,
                'updated_at' => $query->updated_at,
                'rating' => $avg_comments,
                'rating_count' => $count
            ];
        });

     
        return view('front.index',compact('data'));
    }



  
    public function categories($id){
        $data['categories'] = Category::with('childs')->where('status',1)->where('parent_id',0)->get();
        if (request()->has('min') && request()->has('max')) {
            $minimum = request('min');
            $maximum = request('max');
            $products = Product::where(['category_id' => $id, 'status' => 1])->get();
            $product_ids = [];
            foreach($products as $item){
                $last_price = isset($item->discount_percent) && $item->discount_percent != 0 ? $item->price - (($item->price / 100) * $item->discount_percent) : $item->price;
                if ($last_price >= $minimum && $last_price <= $maximum) {
                    array_push($product_ids, $item->id);
                }
            }
            $data['products'] = Product::with('image','category')->where(['category_id' => $id, 'status' => 1])->whereIn('id',$product_ids)->paginate(9);
        }else{
            $data['products'] = Product::with('image','category')->where(['category_id' => $id, 'status' => 1])->paginate(9);
        }
         $this_products = Product::select('id','price','discount_percent')->where(['category_id' => $id, 'status' => 1])->get()->map(function($query){
            return [
                'id' => $query->id,
                'price' => isset($query->discount_percent) && $query->discount_percent != 0 ? $query->price - (($query->price / 100) * $query->discount_percent) : $query->price
            ];
        });
        $max = 0;
        $min = 0;
        if(count($this_products)>=1 ){
            $max = $this_products[0]['price'];
            $min = $this_products[0]['price'];
            foreach($this_products as $item){
                if($item['price'] >= $max){
                    $max = $item['price'];
                }
                if($item['price'] <= $min){
                    $min = $item['price'];
                }
            }
        }
        $data['min'] = $min;
        $data['max'] = $max;
        $data['cat_id'] = $id;
        return view('front.categories',compact('data'));
    }
    public function get_login()
    {
        if(Auth::check()){
            return redirect('/');
        }

        $data['categories'] = Category::with('childs')->where('status',1)->where('parent_id',0)->get();
        return view('front.user.auth',compact('data'));
    
    }
    public function post_login(Request $request)
    {
        $data = $request->data;
        $user = User::where('email', $data['email'])->first();
        if (isset($user)) {
            if (Hash::check($data['password'],$user->password)) {
                Auth::login($user);
                return response(['error' => '0', 'msg' => 'You are logged in']);
            }else{
                return response(['error' => '1', 'msg' => 'Password incorrect']);
            }
        }else{
            return response(['error' => '1', 'msg' => 'User Not found']);
        }
    }
    public function post_register(Request $request)
    {
        $data = $request->data;
        $user = User::where('email', $data['email'])->first();
        if (isset($user)) {
            return response(['error' => '1', 'msg' => 'User already exists']);
        }else{
             $temp = User::create([
                'name' => $data['name'],
                'family' => $data['family'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'mobile' => $data['mobile'],
                'lat' => $data['type'] == 'producer' ? $data['lat'] : 0,
                'lng' => $data['type'] == 'producer' ? $data['lng'] : 0,
                'shop_name' => $data['type'] == 'producer' ? $data['shop_name'] : null,
                'role_id' => $data['type'] == 'producer' ? 3 : 2
            ]);
            Auth::login($temp);
            return response(['error' => '0', 'msg' => 'You are Logged in']);
        }
    }
    public function wishlist()
    {
        if (!Auth::check()) {
            abort('403');
        }
        $user = Auth::user();
        $data['categories'] = Category::with('childs')->where('status',1)->where('parent_id',0)->get();
        $data['wishlist'] = Wishlist::with('product')->where('user_id', $user->id)->get();
        return view('front.user.wishlist',compact('data'));
    }
    public function get_wish_data()
    {
        $data = Wishlist::with('product')->where('user_id', Auth::user()->id)->get()->map(function($query){
            return [
                'id' => $query->id,
                'product_id' => $query->product->id,
                'owner_id' => $query->product->owner_id,
                'title' => $query->product->title,
                'image' => isset($query->product->image) ? route('image-show') . '?image=' . $query->product->image->path : asset('images/no-img.jpg'),
                'shop_name' => $query->product->owner->shop_name,
                'lat' => $query->product->owner->lat,
                'lng' => $query->product->owner->lng,
                'link' => $query->product->product_link != null ? $query->product->product_link : false
            ];
        });
        
        return $data;
    }
    public function add_or_delete_from_wishlist(Request $request,$id,$type)
    {
        if ($type == 'delete') {
            $data = Wishlist::find($id);
            if ($data->user_id == Auth::user()->id) {
                $data->delete();
                return response(['error' => '0', 'msg' => 'your product removed from your wishlist']);
            }
            return response(['error' => '1', 'msg' => "you don't have permission"]);
        }else if($type == 'add'){
            Wishlist::create([
                'user_id' => Auth::user()->id,
                'product_id' => $id
            ]);
            return response(['error' => '0', 'msg' => 'Add Successfuly']);
        }
    }
    public function account_get()
    {
        if(!Auth::check()){
            return redirect('/');
        }
        $data['categories'] = Category::with('childs')->where('status',1)->where('parent_id',0)->get();
        $data['user'] = auth()->user();
        return view('front.user.account',compact('data'));
    }
    public function account_post(Request $request)
    {
          $user = User::where('id', Auth::user()->id)->first();
      
       if($request->cur_password != null || $request->password != null || $request->password_confirmation != null){

           if($request->cur_password != null && $request->password != null && $request->password_confirmation != null){
              if(password_verify($request->cur_password,$user->password)){
                $request->validate([
                   'name' => 'required|min:3|max:20',
                   'family' => 'required|min:3|max:20',
                   'mobile' => 'required|numeric',
                   'email' => 'required|email',
                   'password' => 'required|confirmed|min:6',
               ]);
               $user->update([
                   'name' => $request->name,
                   'family' => $request->family,
                   'mobile' => $request->mobile,
                   'email' => $request->email,
                   'password' => Hash::make($request->password),
                   'shop_name' => isset($request->shop_name) ? $request->shop_name : null
               ]);
           }else{
               return redirect()->back()->with(['error' => 1,'msg' => 'your current password is not correct !!!']);
           }
        }else{
            return redirect()->back()->with(['error' => 1,'msg' => 'Please fill all the required password fileds']);
        }
       }
            
       
            $request->validate([
                'name' => 'required|min:3|max:20',
                'family' => 'required|min:3|max:20',
                'mobile' => 'required|numeric',
                'email' => 'required|email',
            ]);
            $user->update([
                'name' => $request->name,
                'family' => $request->family,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'shop_name' => isset($request->shop_name) ? $request->shop_name : null
            ]);
        
        if($user){
            return redirect()->back()->with(['error' => 0,'msg' => 'successfuly updated']);
        }
        return redirect()->back()->with(['error' => 0,'msg' => 'try again']);
    }
    public function get_producers(){
        $data = User::select('id','shop_name','lat','lng')->where('role_id', 3)->get();
        return $data;
    }
    public function get_wish_producers(){
        $wish_lists = Wishlist::where('user_id', Auth::user()->id)->get();
        $data = User::select('id','shop_name','lat','lng')->where('role_id', 3)->get();
        return $data;
    }
    public function address_get()
    {
        $data['categories'] = Category::with('childs')->where('status',1)->where('parent_id',0)->get();
        $data['address']['lat'] = Auth::user()->lat;
        $data['address']['lng'] = Auth::user()->lng;
        return view('front.user.address',compact('data'));
    }
    public function address_post(Request $request)
    {
        $data = User::find(Auth::user()->id);
        $data->lat = $request->Location_Latitude;
        $data->lng = $request->Location_Longitude;
        if($data->save()){
            return redirect()->back()->with(['error' => 0, 'msg' => 'update successfuly']);
        }else{
            return redirect()->back()->with(['error' => 1, 'msg' => 'try again']);
        }
    }
    public function search(Request $request)
    {
        $data = Product::with('image')->where('title',"LIKE", "%" . $request->search . "%")->get()->map(function($query){
            return [
                'id' => $query->id,
                'title' => $query->title,
                'image' => isset($query->image) ? route('image-show') . '?image=' . $query->image->path : asset('images/no-img.jpg')  
            ];
        });

        return $data;
    }
    public function searchProducer(Request $request)
    {
        $search = $request->search;
        $data = Product::with('image')->get();
        //$data = Product::with('image')->where('parent_id',0)->get();
        $result = [];
        $count = 0;
        foreach($data as $key => $item){
            similar_text($item->title, $search, $percentage);
            if ($percentage > 50) {
                $result[$count]['id'] = $item->id;
                $result[$count]['title'] = $item->title;
                $result[$count]['image'] = isset($item->image) ? route('image-show') . '?image=' . $item->image->path : asset('images/no-img.jpg');
                $count += 1;
            }
        }

        return $result;
    }
    public function productDetail($id)
    {
        $data['categories'] = Category::with('childs')->where('status',1)->where('parent_id',0)->get();
        $user_id = Auth::check() ? Auth::user()->id : false;
        $comments = Comment::where(['product_id' => $id, 'status' => 1])->get();
        $sum_rating = 0;
        foreach($comments as $item){
            $sum_rating += $item->rating;
        }
        $comment_count = count($comments);
       if( $comment_count == 0){
        $comment_count = 1;
       }
        $avg_comments = $sum_rating / $comment_count;
        $data['detail'] = Product::with('image','category','comments')->where(['status' => 1, 'id' => $id])->get()->map(function($query) use($user_id,$avg_comments,$comment_count){
            if ($user_id == false) {
                $wishlist = 'is_not_login';
            }else{
                $data = Wishlist::where(['product_id' => $query->id, 'user_id' => $user_id])->first();
                $wishlist = isset($data) ? 1 : 0;
            }
            
            return [
                'id' => $query->id,
                'title' => $query->title,
                'price' => $query->price,
                'discount_percent' => $query->discount_percent,
                'description' => $query->description,
                'image' => isset($query->image) ? route('image-show') . '?image=' . $query->image->path : asset('images/no-img.jpg'),
                'category' => $query->category->title,
                'parent_category' => $query->category->parent->title,
                'category_id' => $query->category->id,
                'is_wishlist' => $wishlist,
                'product_link' => $query->product_link, 
                'views' => $query->views,
                'avg_comments' => $avg_comments,
                'comment_count' => $comment_count,
                'owner_id'=> $query->owner_id,
                'comments' => $query->comments->map(function($q){
                    return [
                        'id' => $q->id,
                        'description' => $q->description,
                        'rating' => $q->rating * 20,
                        'user_name' => $q->user->name .' '. $q->user->family,
                        'email' => $q->user->email,
                        'created_time' => Carbon::parse($q->created_at)->format('M d Y'),
                    ];
                })
            ];
        })[0];
        $data['suggestion'] = Product::with('image','category')->
        where(['status' => 1,'category_id' => $data['detail']['category_id'],'owner_id'=> $data['detail']['owner_id']])->
        where('id', '<>' ,$id)->get()->take(4)->
        map(function($query) use($user_id){
            if ($user_id == false) {
                $wishlist = 'is_not_login';
            }else{
                $data = Wishlist::where(['product_id' => $query->id, 'user_id' => $user_id])->first();
                $wishlist = isset($data) ? 1 : 0;
            }
            return [
                'id' => $query->id,
                'title' => $query->title,
                'price' => $query->price,
                'discount_percent' => $query->discount_percent,
                'image' => isset($query->image) ? route('image-show') . '?image=' . $query->image->path : asset('images/no-img.jpg'),
                'category' => $query->category->title,
                'parent_category' => $query->category->parent->title,
                'is_wishlist' => $wishlist
            ];
        });
        $data['producers'] = Product::with('image','owner')->where('id','<>',$id)->where('title',$data['detail']['title'])->get()->map(function($query){
            return [
                'id' => $query->id,
                'title' => $query->title,
                'shop_name' => $query->owner->shop_name,
                'price' => $query->price,
                'discount_percent' => $query->discount_percent,
                'image' => isset($query->image) ? route('image-show') . '?image=' . $query->image->path : asset('images/no-img.jpg'),
            ];
        });
        return view('front.productDetail',compact('data'));
    }

    public function commentPost(Request $request, $id){
        if (!Auth::check()) {
            return redirect()->back();
        }else{
            Comment::create([
                'description' => $request->description,
                'status' => 0,
                'rating' => isset($request->rating) ? $request->rating : 0,
                'product_id' => $id,
                'user_id' => Auth::user()->id
            ]);
            return redirect()->back()->with(['error' => 0,'msg' => 'All done , now every one can see your comment ⚡']);
        }
    }

    public function producer_products()
    {
        if (!Auth::check()) {
            abort(403);
        }else{
            if (Auth::user()->role_id != 3) {
                abort(403);
            }
        }
        $user = Auth()->user();
        $data['categories'] = Category::with('childs')->where('status',1)->where('parent_id',0)->get();
        $data['products'] = Product::where(['owner_id' => $user->id])->get()->map(function ($query){
            $comments = Comment::where(['product_id' => $query->id, 'status' => 1])->get();
            $count = count($comments);
            $avg_comments = count($comments) > 0 ? $this->avg_comments($comments,$count) : 0;
            return [
                'id' => $query->id,
                'title' => $query->title,
                'price' => $query->price,
                'discount_percent' => $query->discount_percent,
                'image' => isset($query->image) ? route('image-show') . '?image=' . $query->image->path : asset('images/no-img.jpg'),
                'category' => $query->category,
                'updated_at' => $query->updated_at,
                'rating' => $avg_comments,
                'rating_count' => $count,
                'status' => $query->status
            ];
        });
        return view('front.user.products', compact('data'));
    }
    public function edit_product($id){
        if (!Auth::check()) {
            abort(403);
        }else{
            if (Auth::user()->role_id != 3) {
                abort(403);
            }
        }
        $user = Auth()->user();
        $data['categories'] = Category::with('childs')->where('status',1)->where('parent_id',0)->get();
        $data['parent_categories'] = Category::where('parent_id',0)->get();
        $data['detail'] = Product::with('image','category','comments')->where('owner_id', $user->id)->where(['id' => $id])->get()->map(function($query){
            return [
                'id' => $query->id,
                'title' => $query->title,
                'price' => $query->price,
                'discount_percent' => $query->discount_percent,
                'description' => $query->description,
                'image' => isset($query->image) ? route('image-show') . '?image=' . $query->image->path : null,
                'category_id' => $query->category->id,
                'category' => $query->category->title,
                'parent_category' => $query->category->parent->title,
                'category_parent_id' => $query->category->parent->id,
                'product_link' => $query->product_link,
            ];
        })[0];
        // return $data;
        return view('front.user.product_edit',compact('data'));
    }
    public function update_product(Request $request,$id){
        $validated = $request->validate([
            'title' => 'required|min:3',
            'childern_id' => 'required',
           // 'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'discount_percent' => 'nullable|digits_between:0,100'
        ]);
        $data = Product::find($id)->update([
            'title' => $request->title,
            'owner_id' => auth()->user()->id,
            'category_id' => $request->childern_id,
            'description' => $request->description,
            'price' => $request->price,
            'discount_percent' => isset($request->discount_percent) ? $request->discount_percent : 0,
            'product_link' => $request->product_link
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
    public function create_product(){
        if (!Auth::check()) {
            abort(403);
        }else{
            if (Auth::user()->role_id != 3) {
                abort(403);
            }
        }
        $data['categories'] = Category::with('childs')->where('status',1)->where('parent_id',0)->get();
        $data['parent_categories'] = Category::where('parent_id',0)->get();
        return view('front.user.product_create',compact('data'));
    }
    public function store_product(Request $request){
        $validated = $request->validate([
            'title' => 'required|min:3',
            'childern_id' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'discount_percent' => 'nullable|digits_between:0,100'
        ]);
        $findParent = Product::where('title',$request->title)->first();
        if (isset($findParent)) {
            if ($findParent->owner_id == Auth::user()->id) {
                return redirect()->back()->with(['error' => 1, 'msg' => 'You already added this item before']);
            }
            $data = Product::create([
                'title' => $findParent->title,
                'owner_id' => auth()->user()->id,
                'category_id' => $request->childern_id,
                'parent_id' => $findParent->id,
                'description' => $request->description,
                'price' => $request->price,
                'discount_percent' => isset($request->discount_percent) ? $request->discount_percent : 0,
                'product_link' => $request->product_link
            ]);
        }else{
            $data = Product::create([
                'title' => $request->title,
                'owner_id' => auth()->user()->id,
                'category_id' => $request->childern_id,
                'parent_id' => 0,
                'description' => $request->description,
                'price' => $request->price,
                'discount_percent' => isset($request->discount_percent) ? $request->discount_percent : 0,
                'product_link' => $request->product_link
            ]);
        }
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
    public function priceFilter(){
        $data = $request->only('min','max','cat_id');
        $products = Product::with('image','category')->where(['category_id' => $data['cat_id'], 'status' => 1])->get()->map(function($query){
            $price = isset($query->discount_price) && $query->discount_price != 0 ? $query->price - (($query->price / 100) * $query->discount_price) : $query->price;
            return [
                'id' => $query->id,
                'title' => $query->title,
                'price' => $query->price,
                'discount_percent' => $query->discount_percent,
                'image' => isset($query->image) ? route('image-show') . '?image=' . $query->image->path : asset('images/no-img.jpg'),
                'price' => $price,
            ];
        });
        $result = [];
        $counter = 0;
        foreach($products as $key => $item){
            // if($min <= $item['price'] >= $max){
            //     $result[$counter] = $item;
            //     $counter += 1;
            // }
        }
    }
}
