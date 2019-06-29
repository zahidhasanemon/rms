<?php

namespace App\Http\Controllers;

use App\Store;
use App\Component;
use App\Product;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DB;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::latest()->get();
        return view('pages.store.index',compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all('id','name');
        $suppliers = Supplier::all('id','name');
        return view('pages.store.create', compact('products','suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([ 
            'product_id'  => ['required', Rule::notIn(['','0'])],
            'supplier_selection'  => ['required', Rule::notIn(['','0'])],
            'date'              => 'required',
            'invoice'              => 'required',
            'rate'      => ['required', 'numeric'],
            'quantity'            => ['required', 'integer'],
        ]);

        if ($request->supplier_selection == 2) {
            $supplier = DB::table('suppliers')->insertGetId(
                [
                    'name' => $request->name,
                    'mobile' => $request->mobile,
                    'email' => $request->email,
                    'address' => $request->address
                ]
            );
        }
        else {
            $supplier = $request->supplier_id;
        }

        $store =  new Store;

        $store->date = $request->date;
        $store->supplier_id = $supplier;
        $store->invoice = $request->invoice;
        $store->details = $request->details;
        $store->product_id = $request->product_id;
        $store->rate = $request->rate;
        $store->quantity = $request->quantity;
        $store->amount = $request->amount;

        $store->save();

        $product = Product::find($request->product_id);
        $product->stock = $product->stock + $request->quantity;
        $product->save();

        for ($i=0; $i < $request->quantity  ; $i++) { 
            Component::create([
                'product_id' => $request->product_id,
                'store_id' => $store->id,
                'details' => $request->details,
                'status' => 1,
                'code' => $product->name.str_random(5),
            ]);
        }

        return redirect()
                    ->route('store.index')
                    ->with('success', 'Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        // $suppliers = Supplier::all('id','name');
        // return view('pages.store.edit',compact('store','suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        $product = Product::find($store->product_id);
        $product->stock = $product->stock - $store->quantity;
        $product->save();

        $components = Component::where('store_id','=',$store->id)->get();
        foreach ($components as $component) {
            $component->delete();
        }

        $store->delete();
        return redirect()
                    ->route('store.index')
                    ->with('warning', 'Store Has Been Deleted');
    }
}
