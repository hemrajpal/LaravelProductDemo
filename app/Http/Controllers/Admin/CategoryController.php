<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
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
        $categories = \App\Models\Categories::orderBy('id', 'DESC')->paginate(20); 

        return view('admin.category.categories', [
            'items' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
                'status' => 'required',
            ];

            $validator = Validator::make($request->all(),$rules)->validate();

            $data = $request->input();

            $category = new \App\Models\Categories;            
            $category->name = $data['name'];            
            $category->status = $data['status'] == 'yes' ? 1 : 0;   
            $category->save();

            return redirect()->route('admin.categories');            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = \App\Models\Categories::find($id);  
        if(!$category){
            return redirect()->route('admin.categories');
        }

        return view('admin.category.edit', ['item' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->isMethod('post')) {

            $category = \App\Models\Categories::find($id);  
            if(!$category){
                return redirect()->route('admin.categories');
            }

            $rules = [
                'name' => 'required|string|min:3|max:255',
                'status' => 'required',
            ];

            $validator = Validator::make($request->all(),$rules)->validate();

            $data = $request->input();
 
            $category->name = $data['name'];            
            $category->status = $data['status'] == 'yes' ? 1 : 0;   
            $category->save();

            return redirect()->route('admin.categories');            
        }
    }

    public function delete(Request $request, $id)
    {

        $category = \App\Models\Categories::where('id', $id)->first();

        if(!$category){
            return redirect()->route('admin.products');
        }
        
        if ($request->isMethod('post')) {
            
            $category->delete();

            return redirect()->route('admin.categories');
        }
        
        return view('admin.category.delete', ['category' => $category]);
    }
}
