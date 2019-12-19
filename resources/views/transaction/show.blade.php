@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="col-md-6 " >
                    <div class="card-header"><b>Transaction Details</b></div>
                    <hr>
                    <strong>ID:</strong> {{ $transaction->id }}<br/>
                    <strong>Description: </strong> {{ $transaction->description }}<br>
                    <strong>Sales Date: </strong> {{ $transaction->sales_date }}<br>
                    <strong>Sales Price: </strong> {{ $transaction->sale_price }}<br>
                    <strong>Date Created: </strong> {{ $transaction->created_at }}<br>
                    <strong>Status: </strong> {{ $transaction->status }}
                </div>
                <div class="col-md-6">
                    <div class="card-header"><b>Payment Details</b></div>
                    <hr>
                    @foreach($transaction->payments as $payment)
                        <strong>ID: </strong> {{ $payment->id }}<br/>
                        <strong>Estimated Paid Date: </strong> {{ $payment->estimated_paid_date }}<br>
                        <strong>Estimated Paid Amount: </strong>{{ $payment->estimated_paid_amount }}<br>
                        <strong>Actual Paid Date: </strong>{{ $payment->actual_paid_date }}<br>
                        <strong>Actual Paid Amount: </strong>{{ $payment->actual_paid_amount }}<br>

                    @endforeach
                </div>
            </div>

        </div>
    </div>

@endsection