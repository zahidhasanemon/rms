<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::latest()->get();
        return view('pages.supplier.index',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = null;
        return view('pages.supplier.create', compact('supplier'));
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
            'name'      => 'required|string',
            'mobile'     => 'required',
        ]);

        Supplier::create($request->all());

        return redirect()
                    ->route('supplier.index')
                    ->with('success', 'Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('pages.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name'      => 'required|string',
            'mobile'     => 'required',
        ]);

        $supplier->update($request->all());

        return redirect()
                    ->route('supplier.index')
                    ->with('success', 'Successfully Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()
                    ->route('supplier.index')
                    ->with('warning', 'Supplier Has Been Deleted');
    }

    //autocomplete search of supplier
    public function autocompletesearch(Request $request)
    {
        $query = $request->get('term','');
                
        $suppliers = Supplier::where('name','LIKE','%'.$query.'%')
                            ->get();

        $results=array();                    
        
        if(count($suppliers ) > 0){
            foreach ($suppliers  as $supplier) {
                $results[] = [ 'id' => $supplier['id'], 'text' => $supplier['name']];                  
            }
            return response()->json($results);
        }
    }
}
