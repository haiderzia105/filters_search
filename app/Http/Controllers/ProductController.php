<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    // public function index(){
    //     $products = DB::select('select * from filters_table');
    //     return view('product',['products'=>$products]);
    //     }
    
    public function filterProducts(Request $request) {

       
        $products = Product::get();
        $categories = Category::get();

        if($request->ajax()){
            $prod = Product::where(['category_id'=> $request->category])->get();
            return response()->json(['products'=> $prod]);
        }
        return view('product', compact('categories','products'));
    }
}
