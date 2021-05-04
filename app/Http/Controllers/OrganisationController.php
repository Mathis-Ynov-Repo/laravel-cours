<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class OrganisationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Organisation::with('missions')->get();
        return view('organisations.index', ['organisations' => Organisation::with('missions')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('organisations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'slug' => 'required|unique:organisations|string|max:255',
            'name' => 'required|max:255',
            'address' => 'required',
            'type' => ['required', Rule::in(['school', 'client', 'government'])]

        ]);

        if ($validated->fails()) {
            return redirect()->route('organisations.create')
                ->withErrors($validated)
                ->withInput();
        }
        $organisation = new Organisation();
        $organisation->id = Str::uuid();
        $organisation->address = $request->address;
        $organisation->slug = $request->slug;
        $organisation->email = $request->email;
        $organisation->name = $request->name;
        $organisation->phone = $request->phone;
        $organisation->type = $request->type;
        $organisation->save();
        return redirect()->route('organisations.index')
            ->with('success', 'Orga created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function show(Organisation $organisation)
    {
        // return $organisation->load('missions');
        return view('organisations.show', ['organisation' => $organisation->load('missions')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function edit(Organisation $organisation)
    {
        return view('organisations.edit', compact('organisation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organisation $organisation)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'address' => 'required',
            'type' => ['required', Rule::in(['school', 'client', 'government'])]

        ]);
        if ($validator->fails()) {
            return redirect()->route('organisations.edit', $organisation->id)
                ->withErrors($validator)
                ->withInput();
        }
        $organisation->address = $request->address;
        // $organisation->slug = $request->slug;
        $organisation->email = $request->email;
        $organisation->name = $request->name;
        $organisation->phone = $request->phone;
        $organisation->type = $request->type;
        $organisation->save();

        return redirect()->route('organisations.index')
            ->with('success', 'Orga updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organisation $organisation)
    {
        $organisation->delete();
        return redirect()->route('organisations.index')->with('success', 'Organisation deleted');
    }
}
