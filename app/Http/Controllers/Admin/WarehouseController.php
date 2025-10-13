<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index(Request $request)
    {
        $warehouses = Warehouse::query();

        if( $request->order ){
            $warehouses = $warehouses->orderBy('id' , $request->order);
        }

        if( $request->search ){
            $warehouses = $warehouses->where('name_ar' , 'LIKE' , '%'.$request->search.'%')
                             ->orWhere('name_en' , 'LIKE' , '%'.$request->search.'%')
                             ->orWhere('email' , 'LIKE' , '%'.$request->search.'%')
                             ->orWhere('phone' , 'LIKE' , '%'.$request->search.'%')
                             ->orWhere('responsible_person' , 'LIKE' , '%'.$request->search.'%');
        }

        $warehouses = $warehouses->paginate(15);

        return view('Admin.pages.warehouses.index' , compact('warehouses'));
    }

    public function create()
    {
        return view('Admin.pages.warehouses.create');
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'namr_ar' => 'nullable|min:3|unique:warehouses',
            'namr_en' => 'nullable|min:3|unique:warehouses',
            'email' => 'required|min:3',
            'phone' => 'required|min:8|max:20',
            'phone2' => 'nullable|min:8|max:20|different:phone',
            'address' => 'required',
            'responsible_person' => 'required',
            'description_ar' => 'nullable',
            'description_en' => 'nullable',
        ]);
        
        $warehouse = new Warehouse;
        $warehouse->name_ar = $request->name_ar;
        $warehouse->name_en = $request->name_en;
        $warehouse->email = $request->email;
        $warehouse->phone = $request->phone;
        $warehouse->phone2 = $request->phone2;
        $warehouse->address = $request->address;
        $warehouse->responsible_person = $request->responsible_person;
        $warehouse->description_ar = $request->description_ar;
        $warehouse->description_en = $request->description_en;
        $warehouse->save();

        session()->flash('success', trans('backend.created_successfully'));
        return redirect()->route('admin.warehouses.index');
    }
    
    public function edit(Warehouse $warehouse)
    {
        return view('Admin.pages.warehouses.edit' , compact('warehouse'));
    }

    
    public function update(Request $request, Warehouse $warehouse)
    {
        $request->validate([
            'namr_ar' => 'nullable|min:3|unique:warehouses,namr_ar,' . $warehouse->id,
            'namr_en' => 'nullable|min:3|unique:warehouses,namr_en,' . $warehouse->id,
            'email' => 'required|min:3',
            'phone' => 'required|min:8|max:20',
            'phone2' => 'nullable|min:8|max:20|different:phone',
            'address' => 'required',
            'responsible_person' => 'required',
            'description_ar' => 'nullable',
            'description_en' => 'nullable',
        ]);
        
        $warehouse->name_ar = $request->name_ar;
        $warehouse->name_en = $request->name_en;
        $warehouse->email = $request->email;
        $warehouse->phone = $request->phone;
        $warehouse->phone2 = $request->phone2;
        $warehouse->address = $request->address;
        $warehouse->responsible_person = $request->responsible_person;
        $warehouse->description_ar = $request->description_ar;
        $warehouse->description_en = $request->description_en;
        $warehouse->save();

        session()->flash('success', trans('backend.updated_successfully'));
        return redirect()->route('admin.warehouses.index');
    }

    
    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();

        session()->flash('success', trans('backend.deleted_successfully'));
        return redirect()->back();
    }

    public function activation(Warehouse $warehouse)
    {
        if( $warehouse->status == 1 ){
            $warehouse->status = 0;
            $warehouse->save();
            session()->flash('success', trans('backend.record_disabled_successfully'));
            return redirect()->back();
        }else{
            $warehouse->status = 1;
            $warehouse->save();
            session()->flash('success', trans('backend.record_actived_successfully'));
            return redirect()->back();
        }
        
    }
}
