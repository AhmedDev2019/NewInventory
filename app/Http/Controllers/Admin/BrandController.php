<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $brands = Brand::query();

        if( $request->order ){
            $brands = $brands->orderBy('id' , $request->order);
        }

        if( $request->search ){
            $brands = $brands->where('name_ar' , 'LIKE' , '%'.$request->search.'%')
                             ->orWhere('name_en' , 'LIKE' , '%'.$request->search.'%');
        }

        $brands = $brands->paginate(15);

        return view('Admin.pages.brands.index' , compact('brands'));
    }

    public function create()
    {
        return view('Admin.pages.brands.create');
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'namr_ar' => 'nullable|min:3|unique:brands',
            'namr_en' => 'nullable|min:3|unique:brands',
            'logo' => 'required|image|mimes:png,jpg,jpeg,gif,webp,svg'
        ]);
        
        $brand = new Brand;
        if( $request->logo ){
            Image::make($request->logo)->save('uploads/brands/' . $request->logo->hashName());
            $brand->logo = 'uploads/brands/' . $request->logo->hashName();
        }
        $brand->name_ar = $request->name_ar;
        $brand->name_en = $request->name_en;
        $brand->save();

        session()->flash('success', trans('backend.created_successfully'));
        return redirect()->route('admin.brands.index');
    }
    
    public function edit(Brand $brand)
    {
        return view('Admin.pages.brands.edit' , compact('brand'));
    }

    
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'namr_ar' => 'nullable|min:3|unique:brands,namr_ar,' . $brand->id,
            'namr_en' => 'nullable|min:3|unique:brands,namr_en,' . $brand->id,
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,gif,webp,svg'
        ]);
        
        if( $request->logo ){
            if( $brand->logo != 'uploads/brands/default.png' && file_exists($brand->logo) ){
                unlink($brand->logo);
            }
            Image::make($request->logo)->save('uploads/brands/' . $request->logo->hashName());
            $brand->logo = 'uploads/brands/' . $request->logo->hashName();
        }
        $brand->name_ar = $request->name_ar;
        $brand->name_en = $request->name_en;
        $brand->save();

        session()->flash('success', trans('backend.updated_successfully'));
        return redirect()->route('admin.brands.index');
    }

    
    public function destroy(Brand $brand)
    {
        if( $brand->logo != 'uploads/brands/default.png' && file_exists($brand->logo) ){
            unlink($brand->logo);
        }
        $brand->delete();

        session()->flash('success', trans('backend.deleted_successfully'));
        return redirect()->back();
    }

    public function activation(Brand $brand)
    {
        if( $brand->status == 1 ){
            $brand->status = 0;
            $brand->save();
            session()->flash('success', trans('backend.record_disabled_successfully'));
            return redirect()->back();
        }else{
            $brand->status = 1;
            $brand->save();
            session()->flash('success', trans('backend.record_actived_successfully'));
            return redirect()->back();
        }
        
    }
}
