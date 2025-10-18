<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductCategory;
use App\Models\Supplier;
use App\Models\Warehouse;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query();

        if( $request->order ){
            $products = $products->orderBy('id' , $request->order);
        }

        if( $request->search ){
            $products = $products->where('name_ar' , 'LIKE' , '%'.$request->search.'%')
                             ->orWhere('name_en' , 'LIKE' , '%'.$request->search.'%');
        }

        $products = $products->paginate(15);

        return view('Admin.pages.products.index' , compact('products'));
    }

    public function create()
    {
        $brands = Brand::all();
        $product_categories = ProductCategory::all();
        $suppliers = Supplier::all();
        $warehouses = Warehouse::all();

        return view('Admin.pages.products.create' , compact(
            'brands',
            'product_categories',
            'suppliers',
            'warehouses',
        ));
    }
    
    public function store(Request $request)
    {        
        $request->validate([
            'name_ar' => 'nullable|min:3|unique:products',
            'name_en' => 'nullable|min:3|unique:products',
            'brand_id' => 'required',
            'product_category_id' => 'required',
            'supplier_id' => 'required',
            'warehouse_id' => 'required',
            'code' => 'required|min:6|max:12',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'stock_alert' => 'required|numeric|min:1|max:1000',
            'quantity' => 'required|numeric|min:1|max:1000000',
            'description_ar' => 'nullable',
            'description_en' => 'nullable',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif,webp,svg',
        ]);
        
        $product = new Product;
        if( $request->image ){
            Image::make($request->image)->save('uploads/products/' . $request->image->hashName());
            $product->image = 'uploads/products/' . $request->image->hashName();
        }
        $product->name_ar = $request->name_ar;
        $product->name_en = $request->name_en;
        $product->brand_id = $request->brand_id;
        $product->product_category_id = $request->product_category_id;
        $product->supplier_id = $request->supplier_id;
        $product->warehouse_id = $request->warehouse_id;
        $product->code = $request->code;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->quantity = $request->quantity;
        $product->stock_alert = $request->stock_alert;
        $product->status = $request->status;
        $product->description_ar = $request->description_ar;
        $product->description_en = $request->description_en;
        $product->save();

        // Image Gallery [ Multiple Images ].
        if( $request->multiple_images ){

            // Loop through images from request .
            foreach( $request->multiple_images as $img ){
                // Save Image In Server[App].
                Image::make($img)->save('uploads/products/multi_images/' . $img->hashName());
                $product->image = 'uploads/products/multi_images/' . $img->hashName();

                // Save Image In Database .
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'uploads/products/multi_images/' . $img->hashName()
                ]);
            }
        }

        session()->flash('success', trans('backend.created_successfully'));
        return redirect()->route('admin.products.index');
    }

    public function show(Product $product)
    {
        return view('Admin.pages.products.show' , compact('product'));
    }
    
    public function edit(Product $product)
    {
        $brands = Brand::all();
        $product_categories = ProductCategory::all();
        $suppliers = Supplier::all();
        $warehouses = Warehouse::all();

        return view('Admin.pages.products.edit' , compact(
            'product',
            'brands',
            'product_categories',
            'suppliers',
            'warehouses',
        ));
    }

    
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name_ar' => 'required|min:3|unique:products,name_ar,' . $productCategory->id,
            'name_en' => 'nullable|min:3|unique:products,name_en,' . $productCategory->id,
            'description_ar' => 'nullable',
            'description_en' => 'nullable',
            'icon' => 'nullable|image|mimes:png,jpg,jpeg,gif,webp,svg'
        ]);
        
        if( $request->icon ){
            if( $product_category->icon != 'uploads/products/default.png' && file_exists($product_category->icon) ){
                unlink($product_category->icon);
            }
            Image::make($request->icon)->save('uploads/products/' . $request->icon->hashName());
            $product_category->icon = 'uploads/products/' . $request->icon->hashName();
        }
        $productCategory->name_ar = $request->name_ar;
        $productCategory->name_en = $request->name_en;
        $productCategory->description_ar = $request->description_ar;
        $productCategory->description_en = $request->description_en;
        $productCategory->save();

        session()->flash('success', trans('backend.updated_successfully'));
        return redirect()->route('admin.products.index');
    }

    
    public function destroy(Product $product)
    {
        if( $productCategory->icon != 'uploads/products/default.png' && file_exists($productCategory->icon) ){
            unlink($productCategory->icon);
        }

        $productCategory->delete();

        session()->flash('success', trans('backend.deleted_successfully'));
        return redirect()->back();
    }

    public function activation(Product $product)
    {
        if( $product->active == 1 ){
            $product->active = 0;
            $product->save();
            session()->flash('success', trans('backend.record_disabled_successfully'));
            return redirect()->back();
        }else{
            $product->active = 1;
            $product->save();
            session()->flash('success', trans('backend.record_actived_successfully'));
            return redirect()->back();
        }
        
    }
}
