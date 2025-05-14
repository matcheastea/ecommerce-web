<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        return view('frontend.index');
    }

    public function categories(){
        $categories = Category::where('status', '0')->get();
        return view('frontend.collections.category.index', compact('categories'));
    }

    public function products($category_id){
        $category = Category::findOrFail($category_id);
        $products = Product::where('category_id', $category->id)->where('status', '0')->get();

        if($category){
            return view('frontend.collections.products.index', compact('category', 'products'));
        }else{
            return redirect()->back();
        }   
    }

    public function productView(string $category_id, string $product_id){
        $category = Category::findOrFail($category_id);

        $product = Product::where('category_id', $category->id)->where('id', $product_id)->where('status', '0')->firstOrFail();

        if($category){
            $product = $category->products->where('id', $product_id)->where('status', '0')->firstOrFail();
            if($product){
                return view('frontend.collections.product.view', compact('product','category'));
            }else{
            return redirect()->back();
        }

    }else{
        return redirect()->back();
        }   
     }
}



            

