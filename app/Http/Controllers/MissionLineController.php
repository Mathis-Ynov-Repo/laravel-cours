<?php

namespace App\Http\Controllers;

use App\Models\MissionLine;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;

class MissionLineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MissionLine::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $mission = $request->query->get('mission_id');
        $organisaiton = $request->query->get('organisation_id');
        return view('mission_lines.create')->with(['mission_id' => $mission, 'organisation_id' => $organisaiton]);
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
            'mission_id' => 'required',
            'title' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'unity' => 'required',
        ]);

        if ($validated->fails()) {
            return redirect()->route('mission_lines.create', ['mission_id' => $request->mission_id, 'organisation_id' => $request->organisation_id])
                ->withErrors($validated)
                ->withInput();
        }
        $mission = new MissionLine();
        $mission->id = Str::uuid();
        $mission->mission_id = $request->mission_id;
        $mission->title = $request->title;
        $mission->quantity = $request->quantity;
        $mission->price = $request->price;
        $mission->unity = $request->unity;
        $mission->save();
        return redirect()->route('organisations.edit', $request->organisation_id)
            ->with('success', 'Sub-mission added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MissionLine  $missionLine
     * @return \Illuminate\Http\Response
     */
    public function show(MissionLine $missionLine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MissionLine  $missionLine
     * @return \Illuminate\Http\Response
     */
    public function edit(MissionLine $missionLine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MissionLine  $missionLine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MissionLine $missionLine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MissionLine  $missionLine
     * @return \Illuminate\Http\Response
     */
    public function destroy(MissionLine $missionLine, Request $request)
    {
        $organisation = $request->query->get('organisation_id');
        $missionLine->delete();
        return redirect()->route('organisations.edit', $organisation)->with('success', 'Sub-mission deleted');
    }
}
