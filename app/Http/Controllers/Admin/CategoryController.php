<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //Category
    public function categories(Request $request)
    {
        $search = $request->search;
        if($search){
            $pageTitle = "Search Result of $search";
            $categories = Category::where('name','like',"%$search%")->paginate(getPaginate());

        } else {
            $pageTitle = 'All Categories';
            $categories = Category::latest()->paginate(getPaginate());

        }
        $emptyMessage = "No Categories Available";
        return view('admin.category.categories',compact('pageTitle','emptyMessage','categories','search'));
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
            'image' => 'image|required|mimes:jpg,png,jpeg,PNG'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status ? 1 : 0;
        if($request->image){
            $category->image = uploadImage($request->image,'assets/images/category/','512x512');
        }
        $category->save();
        $notify[]=['success','Category Added successfully'];
        return back()->withNotify($notify);
    }

    public function categoryUpdate(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $request->validate([
            'name' => 'required|unique:categories,name,'.$category->id,
            'image' => 'image|mimes:jpg,png,jpeg,PNG'
        ]);

        
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status ? 1 : 0;
        if($request->image){
            $old = $category->image ?? null;
            $category->image = uploadImage($request->image,'assets/images/category/','512x512',$old);
        }
        $category->save();
        $notify[]=['success','Category Updated successfully'];
        return back()->withNotify($notify);
    }


    //SubCategory
    
    public function subcategories(Request $request)
    {
        $search = $request->search;
        $categories = Category::get(['id','name']);
        if($search){
            $pageTitle = "Search Result of $search";
            $subcategories = SubCategory::where('name','like',"%$search%")->whereHas('category')->with('category')->paginate(getPaginate());

        } else {
            $pageTitle = 'All Sub Categories';
            $subcategories = SubCategory::latest()->whereHas('category')->with('category')->paginate(getPaginate());

        }
        $emptyMessage = "No Sub Categories Available";
        return view('admin.category.subcategories',compact('pageTitle','emptyMessage','subcategories','search','categories'));
    }

    public function subCategoryStore(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sub_categories',
            'category_id'=>'required|numeric|integer'
        ]);

        $subcategory = new SubCategory();
        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->slug = Str::slug($request->name);
        $subcategory->status = $request->status ? 1 : 0;
        $subcategory->save();
        $notify[]=['success','Sub Category Added successfully'];
        return back()->withNotify($notify);
    }

    public function subCategoryUpdate(Request $request)
    {
        $subcategory = SubCategory::findOrFail($request->id);
        $request->validate([
            'name' => 'required|unique:sub_categories,name,'.$subcategory->id,
            'category_id'=>'required|numeric|integer'
        ]);

        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->slug = Str::slug($request->name);
        $subcategory->status = $request->status ? 1 : 0;
        $subcategory->save();
        $notify[]=['success','Sub Category Updated successfully'];
        return back()->withNotify($notify);
    }
}
