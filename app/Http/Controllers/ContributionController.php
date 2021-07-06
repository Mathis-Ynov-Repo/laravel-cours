<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class ContributionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Contribution::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $orga = $request->query->get('organisation_id');
        return view('contributions.create')->with('organisation_id', $orga);
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
            'price' => 'required',
            'comment' => 'required',
            'title' => 'required',
            'organisation_id' => 'required',
        ]);

        if ($validated->fails()) {
            return redirect()->route('contributions.create', ['organisation_id' => $request->organisation_id])
                ->withErrors($validated)
                ->withInput();
        }
        $contribution = new Contribution();
        $contribution->id = Str::uuid();
        $contribution->price = $request->price;
        $contribution->title = $request->title;
        $contribution->comment = $request->comment;
        $contribution->organisation_id = $request->organisation_id;
        $contribution->save();

        $transaction = new Transaction();
        $transaction->id = Str::uuid();
        $transaction->source_type = '\App\Models\Contribution';
        $transaction->source_id = $contribution->id;
        $transaction->price = $request->price;
        $transaction->paid_at = date("Y-m-d H:i:s");

        $transaction->save();

        return redirect()->route('organisations.edit', $request->organisation_id)
            ->with('success', 'Contribution added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contribution  $contribution
     * @return \Illuminate\Http\Response
     */
    public function show(Contribution $contribution)
    {
        return $contribution;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contribution  $contribution
     * @return \Illuminate\Http\Response
     */
    public function edit(Contribution $contribution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contribution  $contribution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contribution $contribution)
    {
        $contribution->price = $request->price;
        $contribution->title = $request->title;
        $contribution->comment = $request->comment;
        $contribution->address = $request->address;
        $contribution->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contribution  $contribution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contribution $contribution, Request $request)
    {
        $organisation = $request->query->get('organisation_id');
        $contribution->delete();
        return redirect()->route('organisations.edit', $organisation)->with('success', 'Contribution deleted');
    }
}
