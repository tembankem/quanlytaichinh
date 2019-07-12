@extends('layouts.layouts');

@section('title') Transfer Money Between Wallets @endsection

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('wallet.index') }}">Wallet</a></li>
    <li class="breadcrumb-item active" aria-current="page">Transfer Money</li>
  </ol>
</nav>
<div class="container">
    <a href= "{{ route('wallet.index') }}" title="Back" class="btn btn-primary mb-3">Back</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Transfer Money Between Wallet') }}</div>

                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('wallet.transfer') }}" aria-label="{{ __('Transfer Money') }}" onsubmit="return confirm('Do you really want to transfer money?');">
                        @csrf
                        <div class="form-group row">
                            <label for="send" class="col-md-4 col-form-label text-md-right">{{ __('Wallet Send') }}</label>

                            <div class="col-md-6">
                                <select name="send" class="form-control{{ $errors->has('send') ? ' is-invalid' : '' }}">
                                	<option value="">Choose Wallet To Send</option>
                                	@foreach($data as $key)
									<option value="{{ $key->id }}">{{ $key->name }}</option>}
                                	@endforeach
                                </select>

                                @if ($errors->has('send'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('send') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

						<div class="form-group row">
                        	<label for="receive" class="col-md-4 col-form-label text-md-right">{{ __('Wallet Receive') }}</label>

                            <div class="col-md-6">
                                <select name="receive" class="form-control{{ $errors->has('receive') ? ' is-invalid' : '' }}">
                                	<option value="">Choose Wallet To Receive</option>
                                	@foreach($data as $key)
    									<option value="{{ $key->id }}">{{ $key->name }}</option>}
                                	@endforeach
                                </select>

                                @if ($errors->has('receive'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('receive') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="money" class="col-md-4 col-form-label text-md-right">{{ __('Money To Transfer') }}</label>

                            <div class="col-md-6">
                                <input id="money" type="number" class="form-control{{ $errors->has('money') ? ' is-invalid' : '' }}" name="money" value="{{ old('money') }}" required>

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
                                <textarea id="note" class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}" name="note" value="{{ old('note') }}"></textarea>

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
                                    {{ __('Transfer') }}
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