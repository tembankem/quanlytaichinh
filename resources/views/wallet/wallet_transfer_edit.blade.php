@extends('layouts.layouts');

@section('title') Edit Transfer @endsection

@section('content')
<div class="container">
    <a href= "{{ route('transaction.index') }}" title="Back" class="btn btn-primary mb-3">Back</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Transfer') }}</div>

                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('wallet.editTransfer', $walletTrans['id']) }}" aria-label="{{ __('Transfer Money') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="money" class="col-md-4 col-form-label text-md-right">{{ __('Money To Transfer') }}</label>

                            <div class="col-md-6">
                                <input id="money" type="number" class="form-control{{ $errors->has('money') ? ' is-invalid' : '' }}" name="money" value="{{ $walletTrans['exchange'] }}" required>

                                @if ($errors->has('money'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('money') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="note" class="col-md-4 col-form-label text-md-right">{{ __('Note (optional)') }}</label>

                            <div class="col-md-6">
                                <textarea id="note" class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}" name="note">{{ $walletTrans['note'] }}</textarea>

                                @if ($errors->has('note'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-5">
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
</div>
@endsection