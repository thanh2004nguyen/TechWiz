<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\product;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index()
    {
        $brands=Provider::get();
        // return $brands;
        $newProducts = product::all()->sortByDesc('created_at')->take(6);
        //    return $newProducts;
        $topProducts = product::orderBy('sales_count', 'desc')
        ->take(6)
        ->get();
        
        return view('dashboard',compact('brands','newProducts','topProducts'));
        
        if (Auth::id()) {
            $is_admin = Auth()->user()->is_admin;
            if ($is_admin == 0) {
                return view('dashboard');
            } else if ($is_admin == 1) {
                return redirect('/admin');
            }
        } else {
            return redirect()->back();
        }
    }

    public function home()
    
    {
        $cart = Cart::fromSession();
        // $categories = Category::all();
        // $brands = Brand::all();
        $id = Auth::id();
        $user = User::find($id);
        // lấy 4 sản phẩm added gần nhất
        $products = Product::with(['images'])
        ->take(6)
        ->orderBy('updated_at', 'desc')
        ->get();

        $topSellingProducts = Product::with(['image','prices','weight'])
        ->orderBy('sales_count', 'desc')
        ->take(6)
        ->get();
        return view('pages.home',compact('products','topSellingProducts','user','categories','brands','cart'));
    }


    public function productDetail($id)
{ 
   
    $product = product::with(['images'])->findOrFail($id);
    // return $product;

  
    $relatePro = product::where('provider_id', $product->provider_id)
    ->where('product_id', '<>', $id)->with('images')
    ->take(5)
    ->get();
    // return $relatePro;
    return view('pages.productdetail', compact('product','relatePro'));
}
}
