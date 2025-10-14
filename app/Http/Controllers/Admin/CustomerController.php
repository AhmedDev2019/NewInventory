<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::query();

        if( $request->order ){
            $customers = $customers->orderBy('id' , $request->order);
        }

        if( $request->search ){
            $customers = $customers->where('name' , 'LIKE' , '%'.$request->search.'%')
                             ->orWhere('email' , 'LIKE' , '%'.$request->search.'%')
                             ->orWhere('phone' , 'LIKE' , '%'.$request->search.'%')
                             ->orWhere('address' , 'LIKE' , '%'.$request->search.'%');
        }

        $customers = $customers->paginate(15);

        return view('Admin.pages.customers.index' , compact('customers'));
    }

    public function create()
    {
        return view('Admin.pages.customers.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'nullable|min:3',
            'phone' => 'required|min:8|max:20',
            'phone2' => 'nullable|min:8|max:20|different:phone',
            'address' => 'nullable',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif,webp,svg'
        ]);
        
        $customer = new Customer;
        if( $request->image ){
            Image::make($request->image)->save('uploads/customers/' . $request->image->hashName());
            $customer->image = 'uploads/customers/' . $request->image->hashName();
        }
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->phone2 = $request->phone2;
        $customer->address = $request->address;
        $customer->save();

        session()->flash('success', trans('backend.created_successfully'));
        return redirect()->route('admin.customers.index');
    }

    public function show(Customer $customer)
    {
        return view('Admin.pages.customers.show' , compact('customer'));
    }
    
    public function edit(Customer $customer)
    {
        return view('Admin.pages.customers.edit' , compact('customer'));
    }

    
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'nullable|min:3',
            'phone' => 'required|min:8|max:20',
            'phone2' => 'nullable|min:8|max:20|different:phone',
            'address' => 'nullable',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif,webp,svg'
        ]);
        
        if( $request->image ){
            if( $customer->image != 'uploads/customers/default.png' && file_exists($customer->image) ){
                unlink($customer->image);
            }
            Image::make($request->image)->save('uploads/customers/' . $request->image->hashName());
            $customer->image = 'uploads/customers/' . $request->image->hashName();
        }
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->phone2 = $request->phone2;
        $customer->address = $request->address;
        $customer->save();

        session()->flash('success', trans('backend.updated_successfully'));
        return redirect()->route('admin.customers.index');
    }

    
    public function destroy(Customer $customer)
    {
        if( $customer->logo != 'uploads/customers/default.png' && file_exists($customer->logo) ){
            unlink($customer->logo);
        }

        $customer->delete();

        session()->flash('success', trans('backend.deleted_successfully'));
        return redirect()->back();
    }

    public function activation(Customer $customer)
    {
        if( $customer->status == 1 ){
            $customer->status = 0;
            $customer->save();
            session()->flash('success', trans('backend.record_disabled_successfully'));
            return redirect()->back();
        }else{
            $customer->status = 1;
            $customer->save();
            session()->flash('success', trans('backend.record_actived_successfully'));
            return redirect()->back();
        }
    }
}
