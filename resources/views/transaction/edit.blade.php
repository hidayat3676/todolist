@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center"><b>{{ __('Create Transaction') }}</b></div>
                <br/>
                <div class="card-body">
                    <form method="POST" action="{{ route('transactions.update',[$transaction->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="sales-date" class="col-md-4 col-form-label text-md-right">{{ __('Sales Date') }}</label>

                            <div class="col-md-6">
                                <input id="sales-date" type="date" class="form-control @error('salesDate') is-invalid @enderror" name="salesDate" value="{{ $transaction->sales_date }}" required  autofocus>

                                @error('salesDate')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sales-price" class="col-md-4 col-form-label text-md-right">{{ __('Sales Price') }}</label>

                            <div class="col-md-6">
                                <input id="sales-price" type="number" class="form-control @error('salesPrice') is-invalid @enderror" name="salesPrice" value="{{ $transaction->sale_price }}" required autocomplete="salesPrice">

                                @error('salesPrice')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="description">{{ __('Description') }}</label>
                            <div class="col-md-6">
                                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" required>{{ $transaction->description }}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <label for="none" class="col-md-4 text-md-right col-form-label">Payment Details</label>
                            <hr>
                        </div>
                        @foreach($transaction->payments as $payment)
                        <div class="form-group row">
                            <label for="estimated-paid-date" class="col-md-4 col-form-label text-md-right">{{ __('Estimated Paid Date') }}</label>

                            <div class="col-md-6">
                                <input id="estimated-paid-date" type="date" class="form-control @error('estimatedPaidDate') is-invalid @enderror" value="{{ $payment->estimated_paid_date }}" name="estimatedPaidDate[]" required >

                                @error('estimatedPaidDate')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="estimated-paid-amount" class="col-md-4 col-form-label text-md-right">{{ __('Estimated Paid Amount') }}</label>

                            <div class="col-md-6">
                                <input id="estimated-paid-amount" value="{{ $payment->estimated_paid_amount }}" type="number" class="form-control" name="estimatedPaidAmount[]" required  autocomplete="estimatedPaidAmount">
                                @error('estimatedPaidAmount')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <div class="form-group row">
                                <label for="actual_paid_date" class="col-md-4 col-form-label text-md-right">{{ __('Actual Paid Date') }}</label>

                                <div class="col-md-6">
                                    <input id="actual_paid_date" type="date" class="form-control @error('actualPaidDate') is-invalid @enderror" value="{{ $payment->actual_paid_date }}" name="actualPaidDate[]" readonly >

                                    @error('actualPaidDate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="actual-paid-amount" class="col-md-4 col-form-label text-md-right">{{ __('Actual Paid Amount') }}</label>

                                <div class="col-md-6">
                                    <input id="actual-paid-amount" value="{{ $payment->actual_paid_amount }}" type="number" class="form-control" name="actualPaidAmount[]" readonly  autocomplete="actualPaidAmount">
                                    @error('actualPaidAmount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        @endforeach

                        <div class="form-group row " id="payment-btn">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="javascript:;" class="btn btn-info" id="more-payment">Add More Payment</a>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script type="text/javascript">
        $(function () {
            $('body').on('click', '#more-payment', function () {

                $.ajax({
                    type: 'GET',
                    url: '{{ url('partial-view') }}',
                    success: function (response) {
                        if (response.status == 1){
                            var view = response.view;
                            $(view).insertBefore($('#payment-btn'));
                        }
                    }
                });
            });

        });
    </script>
@endpush