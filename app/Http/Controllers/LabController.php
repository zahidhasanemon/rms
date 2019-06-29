<?php

namespace App\Http\Controllers;

use App\Lab;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labs = Lab::latest()->get();
        return view('pages.lab.index',compact('labs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lab = null;
        $users = User::all('name','id');
        return view('pages.lab.create',compact('lab','users'));
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
            'user_id'  => ['required', Rule::notIn(['','0'])],
            'name'      => 'required|string',
        ]);

        Lab::create($request->all());

        return redirect()
                    ->route('lab.index')
                    ->with('success', 'Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function show(Lab $lab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function edit(Lab $lab)
    {
        $users = User::all('name','id');
        return view('pages.lab.edit',compact('lab','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lab $lab)
    {
        $request->validate([
            'user_id'  => ['required', Rule::notIn(['','0'])],
            'name'      => 'required|string',
        ]);

        $lab->update($request->all());

        return redirect()
                    ->route('lab.index')
                    ->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lab $lab)
    {
        $lab->delete();
        return redirect()
                    ->route('lab.index')
                    ->with('warning', 'Lab Has Been Deleted');
    }
}
