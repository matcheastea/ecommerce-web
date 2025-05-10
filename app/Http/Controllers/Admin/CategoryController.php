<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryFormRequest;


class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create(){
        return view('admin.category.create');
    }
    public function store(CategoryFormRequest $request){
        $validatedData = $request->validated();

        $category = new Category;
        $category->name = $validatedData['name'];
        $category->description = $validatedData['description'];

        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;

            $file->move('uploads/category/', $filename);

            $category->image = $filename;
        }
 
        $category->image = $validatedData['image'];
        $category->status = $request->status == true ?'1':'0';

        $category->save();
        return redirect()->route('admin.category.index')->with('message','Category Added Successfully');
    }

    public function edit(Category $category){
        return view('/admin/category/edit', compact('category'));
    }

    public function update(CategoryFormRequest $request, $category){
        $validatedData = $request->validated();
        
        $category = Category::findOrFail($category);

        $category->name = $validatedData['name'];
        $category->description = $validatedData['description'];

        if($request->hasFile('image')){
            $path = 'uploads/category/'.$category->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;

            $file->move('uploads/category/'.$filename);
            $category->image = $filename;
        }

        $category->status = $request->status == true ?'1':'0';

        $category->update();
        return redirect()->route('admin.category.index')>with('message','Category Updated Successfully');
    }

    public function destroy($id){
        $category = Category::findOrFail($id);

        $path = 'uploads/category/'.$category->image;
        if(File::exists($path)){
            File::delete($path);
        }

        $category->delete();

        return redirect()->route('admin.category.index')->with('message', 'Category Deleted Successfully');
    }
}
