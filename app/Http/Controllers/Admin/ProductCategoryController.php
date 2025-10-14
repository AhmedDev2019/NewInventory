<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductCategoryController extends Controller
{
    public function index(Request $request)
    {
        $product_categories = ProductCategory::query();

        if( $request->order ){
            $product_categories = $product_categories->orderBy('id' , $request->order);
        }

        if( $request->search ){
            $product_categories = $product_categories->where('name_ar' , 'LIKE' , '%'.$request->search.'%')
                             ->orWhere('name_en' , 'LIKE' , '%'.$request->search.'%');
        }

        $product_categories = $product_categories->paginate(15);

        return view('Admin.pages.product_categories.index' , compact('product_categories'));
    }

    public function create()
    {
        return view('Admin.pages.product_categories.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'requireda|min:3|unique:product_categories',
            'name_en' => 'nullable|min:3|unique:product_categories',
            'description_ar' => 'nullable',
            'description_en' => 'nullable',
            'icon' => 'nullable|image|mimes:png,jpg,jpeg,gif,webp,svg'
        ]);
        
        $product_category = new ProductCategory;
        if( $request->icon ){
            Image::make($request->icon)->save('uploads/product_categories/' . $request->icon->hashName());
            $product_category->icon = 'uploads/product_categories/' . $request->icon->hashName();
        }
        $product_category->name_ar = $request->name_ar;
        $product_category->name_en = $request->name_en;
        $product_category->description_ar = $request->description_ar;
        $product_category->description_en = $request->description_en;
        $product_category->save();

        session()->flash('success', trans('backend.created_successfully'));
        return redirect()->route('admin.product_categories.index');
    }

    public function show(ProductCategory $productCategory)
    {
        return view('Admin.pages.product_categories.show' , compact('productCategory'));
    }
    
    public function edit(ProductCategory $productCategory)
    {
        return view('Admin.pages.product_categories.edit' , compact('productCategory'));
    }

    
    public function update(Request $request, ProductCategory $productCategory)
    {
        $request->validate([
            'name_ar' => 'required|min:3|unique:product_categories,name_ar,' . $productCategory->id,
            'name_en' => 'nullable|min:3|unique:product_categories,name_en,' . $productCategory->id,
            'description_ar' => 'nullable',
            'description_en' => 'nullable',
            'icon' => 'nullable|image|mimes:png,jpg,jpeg,gif,webp,svg'
        ]);
        
        if( $request->icon ){
            if( $product_category->icon != 'uploads/product_categories/default.png' && file_exists($product_category->icon) ){
                unlink($product_category->icon);
            }
            Image::make($request->icon)->save('uploads/product_categories/' . $request->icon->hashName());
            $product_category->icon = 'uploads/product_categories/' . $request->icon->hashName();
        }
        $productCategory->name_ar = $request->name_ar;
        $productCategory->name_en = $request->name_en;
        $productCategory->description_ar = $request->description_ar;
        $productCategory->description_en = $request->description_en;
        $productCategory->save();

        session()->flash('success', trans('backend.updated_successfully'));
        return redirect()->route('admin.product_categories.index');
    }

    
    public function destroy(ProductCategory $productCategory)
    {
        if( $productCategory->icon != 'uploads/product_categories/default.png' && file_exists($productCategory->icon) ){
            unlink($productCategory->icon);
        }

        $productCategory->delete();

        session()->flash('success', trans('backend.deleted_successfully'));
        return redirect()->back();
    }

    public function activation(ProductCategory $productCategory)
    {
        if( $productCategory->status == 1 ){
            $productCategory->status = 0;
            $productCategory->save();
            session()->flash('success', trans('backend.record_disabled_successfully'));
            return redirect()->back();
        }else{
            $productCategory->status = 1;
            $productCategory->save();
            session()->flash('success', trans('backend.record_actived_successfully'));
            return redirect()->back();
        }
        
    }
}
