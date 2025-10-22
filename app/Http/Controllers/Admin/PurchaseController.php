<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Warehouse;
use App\Models\Supplier;
use App\Models\Product;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $purchases = Purchase::query();

        if( $request->order ){
            $purchases = $purchases->orderBy('id' , $request->order);
        }

        $purchases = $purchases->paginate(10);

        return view('Admin.pages.purchases.index' , compact('purchases'));
    }

    public function create()
    {
        $warehouses = Warehouse::all();
        $suppliers = Supplier::all();

        return view('Admin.pages.purchases.create' , compact(
            'warehouses',
            'suppliers',
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }

    public function searchProducts(Request $request)
    {   
        $searchedValue = $request->searchedValue;
        $warehouse_id = $request->warehouse_id;

        $products = Product::where(function($query) use ($searchedValue) {
            $query->where('code' , 'LIKE' , "%".$searchedValue."%")
              ->orWhere('name_ar' , 'LIKE' , "%".$searchedValue."%")
              ->orWhere('name_en' , 'LIKE' , "%".$searchedValue."%");
        })
        ->when($warehouse_id , function($q) use ($warehouse_id) {
            $q->where('warehouse_id' , $warehouse_id);
        })
        ->limit(10)
        ->get();

        return view('Admin.pages.purchases.ajax._get-products-content' , compact('products'));
    }
}
