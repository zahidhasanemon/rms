<?php

namespace App\Http\Controllers;

use App\Unit;
use App\User;
use App\Lab;
use App\Component;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::latest()->get();
        return view('pages.unit.index',compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all('name','id');
        $labs = Lab::all('name','id');
        $components = Component::where('status','=','1')
                        ->get();
        return view('pages.unit.create',compact('users','labs','components'));
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
            'assigned_to'  => ['required', Rule::notIn(['','0'])],
            'code'      => 'required|string|unique:units',
        ]);

        //push components to an array to save to the unit
        $components = [];
        for ($i=0; $i < count($request->component_id); $i++) { 
            array_push($components, $request->component_id[$i]);
        }

        $unit = Unit::create([
            'code' => $request->code,
            'assigned_to' => $request->assigned_to,
            'components' => implode('|', $components),
            'details' => $request->details,
            'user_id' => $request->user_id,
            'lab_id' => $request->lab_id,
        ]);

        for ($i=0; $i < count($request->component_id); $i++) { 

            //update component status to in use and add unit id
            $component = Component::find($request->component_id[$i]);
            $component->status = 2;
            $component->unit_id = $unit->id;
            $component->save();
        }

        return redirect()
                    ->route('unit.index')
                    ->with('success', 'Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        $component_id = explode('|', $unit->components);
        $components = [];
        foreach ($component_id as $key => $value) {
            $component = Component::find($value);
            array_push($components, $component);
        }
        return view('pages.unit.show',compact('unit','components'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        $users = User::all('name','id');
        $labs = Lab::all('name','id');
        //old components of the unit
        $component_id = explode('|', $unit->components);
        $oldcomponents = [];
        $components = [];
        //components those are free now
        $freecomponents = Component::where('status','=','1')
                        ->get();
        //push free components to an array to return to the view with old components
        foreach ($freecomponents as $freecomponent) {
            array_push($components, $freecomponent);
        }

        //push old components to old components array and free components array
        foreach ($component_id as $key => $value) {
            $component = Component::find($value);
            array_push($oldcomponents, $component);
            array_push($components, $component);
        }
        return view('pages.unit.edit',compact('unit','oldcomponents','users','labs','components'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'assigned_to'  => ['required', Rule::notIn(['','0'])],
            'code'      => 'required|string|unique:units,code,'.$unit->id,
        ]);
        //change the status of the previous components to free
        $component_id = explode('|', $unit->components);
        foreach ($component_id as $key => $value) {
            $component = Component::find($value);
            $component->status = 1;
            $component->unit_id = null;
            $component->save();
        }

        $components = [];
        for ($i=0; $i < count($request->component_id); $i++) { 
            array_push($components, $request->component_id[$i]);

            //update component status to in use
            $component = Component::find($request->component_id[$i]);
            $component->status = 2;
            $component->unit_id = $unit->id;
            $component->save();
        }
        $unit->update([
            'code' => $request->code,
            'assigned_to' => $request->assigned_to,
            'components' => implode('|', $components),
            'details' => $request->details,
            'user_id' => $request->user_id,
            'lab_id' => $request->lab_id,
        ]);

        return redirect()
                    ->route('unit.index')
                    ->with('success', 'Successfully Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        //change the status of the previous components to free
        $component_id = explode('|', $unit->components);
        foreach ($component_id as $key => $value) {
            $component = Component::find($value);
            $component->status = 1;
            $component->unit_id = null;
            $component->save();
        }
        $unit->delete();

         return redirect()
                    ->route('unit.index')
                    ->with('warning', 'Unit Has Been Deleted');
    }

    //autocomplete search of unit
    public function autocompletesearch(Request $request)
    {
        $query = $request->get('term','');
                
        $units = Unit::where('code','LIKE','%'.$query.'%')
                            ->where('assigned_to','=','3')
                            ->get();

        $results=array();                    
        
        if(count($units ) > 0){
            foreach ($units  as $unit) {
                $results[] = [ 'id' => $unit['id'], 'text' => $unit['code']];                  
            }
            return response()->json($results);
        }
    }
}
