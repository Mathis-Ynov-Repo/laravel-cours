<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->query->get("type");
        $paid = $request->query->get("paid");
        $year = $request->query->get("year");

        $transactions = Transaction::get();
        $conditions = [];
        if ($type) {
            $conditions[] = ["source_type", '\App\Models\\' . ucfirst($type)];
            $transactions = Transaction::where("source_type", '\App\Models\\' . ucfirst($type))->get();
        }
        if ($paid) {
            $conditions[] = ["paid_at", '<>', NULL];
        }
        if ($year) {

            $transactions->filter(function ($value) {
                return $value->created_at->year == $year;
            });
        }
        if (count($conditions) > 0) {

            $transactions = Transaction::where($conditions)->get();

            return view('transactions.index', ['transactions' => $transactions]);
        }

        return view('transactions.index', ['transactions' => $transactions]);
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
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
