<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\MissionLine;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;



class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Mission::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $orga = $request->query->get('organisation_id');
        return view('missions.create')->with('organisation_id', $orga);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $validated = Validator::make($request->all(), [
            'reference' => 'required|max:255',
            'organisation_id' => 'required',
            'title' => 'required',
            'deposit' => 'required',
        ]);

        if ($validated->fails()) {
            return redirect()->route('missions.create', ['organisation_id' => $request->organisation_id])
                ->withErrors($validated)
                ->withInput();
        }
        $mission = new Mission();
        $mission->id = Str::uuid();
        $mission->reference = $request->reference;
        $mission->organisation_id = $request->organisation_id;
        $mission->title = $request->title;
        $mission->comment = $request->comment;
        $mission->deposit = $request->deposit;
        $mission->ended_at = $request->ended_at;
        $mission->save();
        $transaction = new Transaction();
        $transaction->id = Str::uuid();
        $transaction->source_type = '\App\Models\Mission';
        $transaction->source_id = $mission->id;
        $transaction->price = $mission->deposit;
        $transaction->save();
        if (isset($request->missionLines)) {
            foreach ($request->missionLines as $missionLine) {
                $newMissionLine = new MissionLine();
                $newMissionLine->id = Str::uuid();
                $newMissionLine->mission_id = $mission->id;
                $newMissionLine->title = $missionLine['title'];
                $newMissionLine->quantity = $missionLine['quantity'];
                $newMissionLine->price = $missionLine['price'];
                $newMissionLine->unity = $missionLine['unity'];
                $newMissionLine->save();
            }
        }
        return redirect()->route('organisations.edit', $request->organisation_id)
            ->with('success', 'Mission added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function show(Mission $mission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function edit(Mission $mission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mission $mission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mission $mission, Request $request)
    {
        $organisation = $request->query->get('organisation_id');
        $mission->delete();
        return redirect()->route('organisations.edit', $organisation)->with('success', 'Mission deleted');
    }

    // Generate PDF
    public function createPDF(Mission $mission)
    {
        $total = 0;
        foreach ($mission->missionLines as $line)
            $total += $line->price * $line->quantity;

        // share data to view
        view()->share('mission', $mission);
        view()->share('total', $total);

        $pdf = PDF::loadView('pdfview',  [$mission, $total]);

        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
    }
}
