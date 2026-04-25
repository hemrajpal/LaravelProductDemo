<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = \App\Models\Products::select(
                                                    "products.id", 
                                                    "products.name",
                                                    "products.price", 
                                                    "products.description", 
                                                    "products.status", 
                                                    "products.image", 
                                                    "products.created_at",  
                                                    "categories.name as category_name"
                                                )
                                                ->leftJoin("categories", "categories.id", "=", "products.category")
                                                ->orderBy('products.id', 'DESC')->paginate(20);

        return view('admin.dashboard', [
            'items' => $products
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Models\Categories::orderBy('id', 'ASC')->get();

        return view('admin.product.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $rules = [
                'name' => 'required|string|min:3|max:255',
                'price' => 'required|integer',
                'category' => 'required|integer',
            ];

            if ($request->hasFile('photo')) {
                $request->validate([
                    'photo' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
                ]);
            }

            $validator = Validator::make($request->all(),$rules)->validate();

            $data = $request->input();

            $product = new \App\Models\Products;            
            $product->name = $data['name'];            
            $product->price = $data['price'];            
            $product->description = $data['description'];
            $product->category = $data['category'];
            $product->save();

            if ($request->hasFile('photo')) {
                $fileName = $request->file('photo')->getClientOriginalName();
                $request->file('photo')->store('public/images');
                $filePath = 'images/'.$request->file('photo')->hashName();

                $product->image = $filePath;
                $product->save();
            }

            return redirect()->route('admin.products');            
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products, $id)
    {

        $product = \App\Models\Products::find($id);  
        if(!$product){
            return redirect()->route('admin.products');
        }

        $categories = \App\Models\Categories::orderBy('id', 'ASC')->get();

        return view('admin.product.edit', ['item' => $product, 'categories' => $categories]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->isMethod('post')) {

            $product = \App\Models\Products::where('id', $id)->first();  
            if(!$product){                    
                return redirect()->route('admin.products');
            }

            $rules = [
                'name' => 'required|string|min:3|max:255',
                'price' => 'required|numeric',
                'category' => 'required|integer',
            ];

            if ($request->hasFile('photo')) {
                $request->validate([
                    'photo' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
                ]);
            }

            $validator = Validator::make($request->all(),$rules)->validate();

            $data = $request->input();
 
            $product->name = $data['name'];            
            $product->price = $data['price'];            
            $product->description = $data['description'];
            $product->category = $data['category'];
            $product->save();

            if ($request->hasFile('photo')) {
                $fileName = $request->file('photo')->getClientOriginalName();
                $request->file('photo')->store('public/images');
                $filePath = 'images/'.$request->file('photo')->hashName();

                $product->image = $filePath;
                $product->save();
            }

            return redirect()->route('admin.products');            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $products)
    {
        $product = \App\Models\Products::where('id', $id)->first();
    }

    public function delete(Request $request, $id)
    {

        $product = \App\Models\Products::where('id', $id)->first();

        if(!$product){
            return redirect()->route('admin.products');
        }
        
        if ($request->isMethod('post')) {
            
            $product->delete();

            return redirect()->route('admin.products');
        }
        
        return view('admin.product.delete', ['product' => $product]);
    }
}
