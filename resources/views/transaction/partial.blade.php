<div class="form-group row">
    <label for="estimated-paid-date" class="col-md-4 col-form-label text-md-right">{{ __('Estimated Paid Date') }}</label>

    <div class="col-md-6">
        <input id="estimated-paid-date" type="date" class="form-control @error('estimatedPaidDate') is-invalid @enderror" name="estimatedPaidDate[]"  >

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
        <input id="estimated-paid-amount" type="number" class="form-control" name="estimatedPaidAmount[]"  autocomplete="estimatedPaidAmount">
        @error('estimatedPaidAmount')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>