<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $suppliers = Supplier::query();

        if( $request->order ){
            $suppliers = $suppliers->orderBy('id' , $request->order);
        }

        if( $request->supplier_type ){
            $suppliers = $suppliers->where('supplier_type' , $request->supplier_type);
        }

        if( $request->search ){
            $suppliers = $suppliers->where('name' , 'LIKE' , '%'.$request->search.'%')
                             ->orWhere('email' , 'LIKE' , '%'.$request->search.'%')
                             ->orWhere('phone' , 'LIKE' , '%'.$request->search.'%')
                             ->orWhere('address' , 'LIKE' , '%'.$request->search.'%');
        }

        $suppliers = $suppliers->paginate(15);

        return view('Admin.pages.suppliers.index' , compact('suppliers'));
    }

    public function create()
    {
        return view('Admin.pages.suppliers.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'supplier_type' => 'required|in:person,company',
            'name' => 'required|min:3',
            'email' => 'required|min:3',
            'phone' => 'required|min:8|max:20',
            'phone2' => 'nullable|min:8|max:20|different:phone',
            'address' => 'nullable',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,gif,webp,svg'
        ]);
        
        $supplier = new Supplier;
        if( $request->logo ){
            Image::make($request->logo)->save('uploads/suppliers/' . $request->logo->hashName());
            $supplier->logo = 'uploads/suppliers/' . $request->logo->hashName();
        }
        $supplier->supplier_type = $request->supplier_type;
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->phone2 = $request->phone2;
        $supplier->address = $request->address;
        $supplier->save();

        session()->flash('success', trans('backend.created_successfully'));
        return redirect()->route('admin.suppliers.index');
    }

    public function show(Supplier $supplier)
    {
        return view('Admin.pages.suppliers.show' , compact('supplier'));
    }
    
    public function edit(Supplier $supplier)
    {
        return view('Admin.pages.suppliers.edit' , compact('supplier'));
    }

    
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'supplier_type' => 'required|in:person,company',
            'name' => 'required|min:3',
            'email' => 'required|min:3',
            'phone' => 'required|min:8|max:20',
            'phone2' => 'nullable|min:8|max:20|different:phone',
            'address' => 'nullable',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,gif,webp,svg'
        ]);
        
        if( $request->logo ){
            if( $supplier->logo != 'uploads/suppliers/default.png' && file_exists($supplier->logo) ){
                unlink($supplier->logo);
            }
            Image::make($request->logo)->save('uploads/suppliers/' . $request->logo->hashName());
            $supplier->logo = 'uploads/suppliers/' . $request->logo->hashName();
        }
        $supplier->supplier_type = $request->supplier_type;
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->phone2 = $request->phone2;
        $supplier->address = $request->address;
        $supplier->save();

        session()->flash('success', trans('backend.updated_successfully'));
        return redirect()->route('admin.suppliers.index');
    }

    
    public function destroy(Supplier $supplier)
    {
        if( $supplier->logo != 'uploads/suppliers/default.png' && file_exists($supplier->logo) ){
            unlink($supplier->logo);
        }

        $supplier->delete();

        session()->flash('success', trans('backend.deleted_successfully'));
        return redirect()->back();
    }

    public function activation(Supplier $supplier)
    {
        if( $supplier->status == 1 ){
            $supplier->status = 0;
            $supplier->save();
            session()->flash('success', trans('backend.record_disabled_successfully'));
            return redirect()->back();
        }else{
            $supplier->status = 1;
            $supplier->save();
            session()->flash('success', trans('backend.record_actived_successfully'));
            return redirect()->back();
        }
        
    }
}
