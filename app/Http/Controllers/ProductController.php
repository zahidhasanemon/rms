<?php

namespace App\Http\Controllers;

use App\Product;
use App\SubCategory;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('pages.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = null;
        $categories = Category::all('id','name');
        return view('pages.product.create', compact('product','categories'));
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
            'category_id'  => ['required', Rule::notIn(['','0'])],
            'sub_category_id'  => ['required', Rule::notIn(['','0'])],
            'name'      => 'required|string',
            'image'     => 'mimes:jpeg,png',
        ]);

        if(!empty($request->file('image')))
        {
            $file = $request->file('image') ;
            $image = time() . '.' . $file->getClientOriginalExtension() ;
            $destinationPath = public_path().'/images/products/' ;
            $file->move($destinationPath,$image);
        }
        else {
            $image = 'default.png';
        }

        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'details' => $request->details,
            'image' => $image
        ]);

        return redirect()
                    ->route('product.index')
                    ->with('success', 'Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all('id','name');
        return view('pages.product.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id'  => ['required', Rule::notIn(['','0'])],
            'sub_category_id'  => ['required', Rule::notIn(['','0'])],
            'name'      => 'required|string',
            'image'     => 'mimes:jpeg,png',
        ]);

        if(!empty($request->file('image')))
        {
            $file = $request->file('image') ;
            $image = time() . '.' . $file->getClientOriginalExtension() ;
            $destinationPath = public_path().'/images/products/' ;
            $file->move($destinationPath,$image);
            $product->image = $image;
            $product->save();
        }

        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'details' => $request->details,
        ]);

        return redirect()
                    ->route('product.index')
                    ->with('success', 'Successfully Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()
                    ->route('product.index')
                    ->with('warning', 'Product Has Been Deleted');
    }

    //return the subcategory list of a selected category
    public function getSubCategory($id){
        $subcategories = SubCategory::where([
                        ['category_id','=', $id]
                    ])->get();
        return $subcategories;
    }

    //autocomplete search of product
    public function autocompletesearch(Request $request)
    {
        $query = $request->get('term','');
                
        $products = Product::where('name','LIKE','%'.$query.'%')
                            ->get();

        $results=array();                    
        
        if(count($products ) > 0){
            foreach ($products  as $product) {
                $results[] = [ 'id' => $product['id'], 'text' => $product['name']];                  
            }
            return response()->json($results);
        }
    }
}
