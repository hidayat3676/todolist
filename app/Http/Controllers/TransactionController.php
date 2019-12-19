<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use App\Payment;
class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::all();
        $title = "All Transaction.";
        return view('transaction.index', compact('transactions', 'title'));
    }

    public function adminIndex(){
     $transactions = Transaction::all();
     $title = "Admin All Transaction.";
     return view('admin.index', compact('transactions', 'title'));
    }

    public function loadMorePartialView(){
        $view = view('transaction.partial')->render();

        return response()->json(['view' => $view, 'status' => 1]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create new Transaction.";
        return view('transaction.create', compact( 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'salesDate' => 'required|date', 'salesPrice' => 'required',
                'description' => 'required', 'estimatedPaidDate' => 'required', 'estimatedPaidAmount' => 'required'
            ]);
        $transaction = new Transaction();
        $transaction->sales_date = $request->salesDate;
        $transaction->sale_price = $request->salesPrice;
        $transaction->description = $request->description;
        $transaction->status = 'draft';
        $transaction->user_id = auth()->user()->id;
        $transaction->save();
        $estimatedPaidDates = $request->estimatedPaidDate;
        $estimatedPaidAmount = $request->estimatedPaidAmount;

        foreach ($estimatedPaidDates as $key => $estimatedDate){
            $payment = new Payment();
            $payment->estimated_paid_date = $estimatedDate;
            $payment->estimated_paid_amount = $estimatedPaidAmount[$key];
            $payment->transaction_id = $transaction->id;
            $payment->save();
        }

        return redirect()->route('transactions.index')->with('success', 'Transaction Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::where('id', $id)->first();
        $title = "Transaction Details";

        return view('transaction.show', compact('transaction','title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = Transaction::where('id', $id)->first();

        if ($transaction && $transaction->status == 'draft'){
            $title = 'Update Transaction';
            return view('transaction.edit', compact('transaction','title'));
        }

        return back()->with('error', 'You cannot Edit completed transaction!');
    }

    public function adminEdit($id)
    {
        $transaction = Transaction::where('id', $id)->first();

        if ($transaction && $transaction->status == 'draft'){
            $title = 'Admin Update Transaction';
            return view('admin.edit', compact('transaction','title'));
        }

        return back()->with('error', 'You cannot Edit completed transaction!');
    }

    public function adminUpdate(Request $request, $id)
    {
        $request->validate(
            [
                'salesDate' => 'required|date', 'salesPrice' => 'required',
                'description' => 'required', 'estimatedPaidDate' => 'required', 'estimatedPaidAmount' => 'required'
            ]);
        $transaction = Transaction::where('id', $id)->first();
        if ($transaction) {
            $transaction->sales_date = $request->salesDate;
            $transaction->sale_price = $request->salesPrice;
            $transaction->description = $request->description;
            $transaction->status = 'draft';
            $transaction->user_id = auth()->user()->id;
            $transaction->save();
            $estimatedPaidDates = $request->estimatedPaidDate;
            $estimatedPaidAmount = $request->estimatedPaidAmount;
            $actualPaidDate      = $request->actualPaidDate;
            $actualPaidAmount    = $request->actualPaidAmount;

            Payment::where('transaction_id', $transaction->id)->delete();
            foreach ($estimatedPaidDates as $key => $estimatedDate) {
                $payment = new Payment();
                $payment->estimated_paid_date = $estimatedDate;
                $payment->estimated_paid_amount = $estimatedPaidAmount[$key];
                if (!empty($actualPaidDate[$key])){
                    $payment->actual_paid_date = $actualPaidDate[$key];
                }
                if (!empty($actualPaidAmount[$key])){
                    $payment->actual_paid_amount = $actualPaidAmount[$key];
                    if ($actualPaidAmount[$key] == $estimatedPaidAmount[$key]){
                        $transaction->status = 'completed';
                        $transaction->save();
                    }
                }
                $payment->transaction_id = $transaction->id;
                $payment->save();
            }
            return redirect('/admin/transactions')->with('success', 'Transaction Updated!');
        }
        return redirect('/admin/transactions')->with('error', 'Transaction Not found try again!');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'salesDate' => 'required|date', 'salesPrice' => 'required',
                'description' => 'required', 'estimatedPaidDate' => 'required', 'estimatedPaidAmount' => 'required'
            ]);
        $transaction = Transaction::where('id', $id)->first();
        if ($transaction) {
            $transaction->sales_date = $request->salesDate;
            $transaction->sale_price = $request->salesPrice;
            $transaction->description = $request->description;
            $transaction->status = 'draft';
            $transaction->user_id = auth()->user()->id;
            $transaction->save();
            $estimatedPaidDates = $request->estimatedPaidDate;
            $estimatedPaidAmount = $request->estimatedPaidAmount;

            Payment::where('transaction_id', $transaction->id)->delete();
            foreach ($estimatedPaidDates as $key => $estimatedDate) {
                $payment = new Payment();
                $payment->estimated_paid_date = $estimatedDate;
                $payment->estimated_paid_amount = $estimatedPaidAmount[$key];
                $payment->transaction_id = $transaction->id;
                $payment->save();
            }
            return redirect()->route('transactions.index')->with('success', 'Transaction Updated!');
        }
        return redirect()->route('transactions.index')->with('error', 'Transaction Not found try again!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::where('id', $id)->first();
        if ($transaction){
            if ($transaction->delete()){
                return back()->with('success', 'Transaction deleted!');
            }
            return back()->with('error', 'Error! could not delete Transaction tray again.');
        }
        return back()->with('error', 'Error! Transaction not found.');
    }
}
