@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header text-center"><b>All Transactions</b>
            </div>
            <br/>
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
                                        <a href="{{ url('admin/edit-transaction',[$transaction->id]) }}" class="btn btn-warning">Edit</a>
                                    @endif
                                    <a id="delete-transaction" href="{{ route('transactions.destroy',[$transaction->id]) }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        <tr></tr>
                        </tbody>
                    </table>
                    <form method="POST" action="" id="delete-transaction-form">
                        @csrf()
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>

    </div>
    @endsection
@push('script')
    <script type="text/javascript">
        $(function () {
            $('body').on('click','#delete-transaction', function (e) {
                e.preventDefault();
               var url = $(this).attr('href');
               var form = $('#delete-transaction-form');
               form.attr('action', url);
               form.submit();
            });
        });

    </script>
    @endpush