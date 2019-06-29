<?php

namespace App\Http\Controllers;

use App\Component;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $components = Component::latest()->get();
        return view('pages.component.index',compact('components'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function show(Component $component)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function edit(Component $component)
    {
        return view('pages.component.edit',compact('component'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Component $component)
    {
        $request->validate([
            'status'  => ['required', Rule::notIn(['','0'])],
        ]);

        $component->update([
            'status' => $request->status,
        ]);

        return redirect()
                    ->route('component.index')
                    ->with('success', 'Status Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function destroy(Component $component)
    {
        $component->delete();
        return redirect()
                    ->route('component.index')
                    ->with('warning','Component Has Been Deleted');
    }

    //autocomplete search of component
    public function autocompletesearch(Request $request)
    {
        $query = $request->get('term','');
                
        $components = Component::where('code','LIKE','%'.$query.'%')
                            ->where('status','=','1')
                            ->get();

        $results=array();                    
        
        if(count($components ) > 0){
            foreach ($components  as $component) {
                $results[] = [ 'id' => $component['id'], 'text' => $component['code']];                  
            }
            return response()->json($results);
        }
    }
}
