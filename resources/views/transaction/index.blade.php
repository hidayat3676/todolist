@extends('layouts.app')

@section('content')
<div class="row">
    <div class="card">
        <div class="card-header text-center"><div class="text-left"><a href="{{ route('transactions.create') }}" class="btn btn-warning">Create Transaction</a> </div>All Transactions</div>
        <div class="card-body">

            <div class="col-md-12">
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Sales Date</th>
                        <th>Sales Price</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr></thead>
                    <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->sales_date }}</td>
                            <td>{{ $transaction->sale_price }}</td>
                            <td>{{ $transaction->description }}</td>
                            <td>{{ $transaction->status }}</td>

                            <td><a href="{{ route('transactions.show', [$transaction->id]) }}" class="btn btn-info">view </a>
                            @if($transaction->status == 'draft')
                                <a href="{{ route('transactions.edit',[$transaction->id]) }}" class="btn btn-warning">Edit</a>
                            @endif
                            </td>
                        </tr>
                    @endforeach
                    <tr></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection