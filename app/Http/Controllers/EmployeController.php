<?php

namespace App\Http\Controllers;

use App\Employe;
use App\Http\Requests\EditCompanyRequest;
use App\Http\Requests\EditEmployeRequest;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employe::paginate(10);

        return view('employe.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employe.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EditEmployeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EditEmployeRequest $request)
    {
        $employe = new Employe(
            $request->all()
        );
        $employe->fill($request->all());
        $employe->saveOrFail();
        return \Redirect::route('employe.edit', compact('employe'))->with('success', 'Saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function show(Employe $employe)
    {
        return view('employe.show', compact('employe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function edit(Employe $employe)
    {
        return view('employe.edit', compact('employe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditEmployeRequest  $request
     * @param  \App\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function update(EditEmployeRequest $request, Employe $employe)
    {
        $employe->update($request->all());
        return \Redirect::route('employe.edit', compact('employe'))->with('success', 'Saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employe $employe)
    {
        $employe->delete();
        return \Redirect::route('employe.index')->with('success', 'Deleted!');
    }
}
