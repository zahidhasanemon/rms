<?php

namespace App\Http\Controllers;

use App\Requisition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Component;
use App\Unit;
use App\Assignment;
use App\User;

class RequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requisitions = Requisition::latest()->get();
        return view('pages.requisition.index',compact('requisitions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $requisition = null;
        $user = Auth::user();
        return view('pages.requisition.create',compact('requisition','user'));
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
            'requisition_for'  => ['required', Rule::notIn(['','0'])],
            'date'      => 'required|date',
            'details'      => 'required',
        ]);

        Requisition::create([
            'date' => $request->date,
            'requisition_for' => $request->requisition_for,
            'details' => $request->details,
            'user_id' => Auth::id()
        ]);

        return redirect()
                    ->route('requisition.index')
                    ->with('success', 'Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function show(Requisition $requisition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function edit(Requisition $requisition)
    {
        $user = Auth::user();
        return view('pages.requisition.edit',compact('requisition','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requisition $requisition)
    {
        $request->validate([
            'requisition_for'  => ['required', Rule::notIn(['','0'])],
            'date'      => 'required|date',
            'details'      => 'required',
        ]);

        $requisition->update([
            'date' => $request->date,
            'requisition_for' => $request->requisition_for,
            'details' => $request->details,
            'user_id' => Auth::id()

        ]);

        return redirect()
                    ->route('requisition.index')
                    ->with('success', 'Successfully Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requisition $requisition)
    {
        $requisition->delete();
        return redirect()
                    ->route('requisition.index')
                    ->with('warning', 'Requisition Has Been Deleted');
    }


    /**
     * Show the form for assigning items of a requisition.
     *
     * @return \Illuminate\Http\Response
     */
    public function assignmentForm($id)
    {
        $requisition = Requisition::find($id);
        $components = Component::where('status','=','1')
                        ->get();
        $units = Unit::where('assigned_to','=','3')
                        ->get();
        return view('pages.requisition.assignment-form',compact('requisition','components','units'));
    }

    /**
     * Store the assigning items of a requisition.
     *
     * @return \Illuminate\Http\Response
     */
    public function assignmentStore(Request $request)
    {
        //push components to an array to save
        $components = [];
        if (!empty($request->component_id)) {
            
            for ($i=0; $i < count($request->component_id); $i++) { 
                array_push($components, $request->component_id[$i]);
            }
        }
        
        //push units to an array to save
        $units = [];

        if (!empty($request->unit_id)) {
            
            for ($i=0; $i < count($request->unit_id); $i++) { 
                array_push($units, $request->unit_id[$i]);
            }
        }

        $requisition = Requisition::find($request->requisition_id);
        $user = User::find($requisition->user_id);
        $lab = $user->lab;

        $assignment = Assignment::create([
            'requisition_id' => $requisition->id,
            'components' => implode('|', $components),
            'units' => implode('|', $units),
            'details' => $request->details,
        ]);

        if (!empty($request->component_id)) {

            for ($i=0; $i < count($request->component_id); $i++) { 

                //update component status to in use and add unit id
                $component = Component::find($request->component_id[$i]);
                $component->status = 2;

                if ($requisition->requisition_for == 1) {

                    $component->user_id = $requisition->user_id;

                }
                else{
                    $component->lab_id = $lab->id;
                }
                
                $component->save();
            }
        }

        if (!empty($request->unit_id)) {
            
            for ($i=0; $i < count($request->unit_id); $i++) { 

                //update unit status to in use and add unit id
                $unit = Unit::find($request->unit_id[$i]);

                if ($requisition->requisition_for == 1) {
                    $unit->assigned_to = 1;

                    $unit->user_id = $requisition->user_id;

                }
                else{
                    $unit->assigned_to = 2;
                    $unit->lab_id = $lab->id;
                }
                
                $unit->save();
            }
        }

        $requisition->status = $request->status;
        $requisition->save();

        return redirect()
                    ->route('requisition.index')
                    ->with('success', 'Successfully Assigned');
    }
}
