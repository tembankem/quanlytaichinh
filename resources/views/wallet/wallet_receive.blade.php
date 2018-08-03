@extends('layouts.layouts');

@section('title') Transfer Money From Wallet {{ $data['walletSend']->name }} @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Choose Wallet To Receive Money') }}</div>

                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('wallet.chooseReceiveWallet',$data['walletSend']->id) }}" aria-label="{{ __('Choose Receive Wallet') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="receive" class="col-md-4 col-form-label text-md-right">{{ __('Wallet Receive') }}</label>

                            <div class="col-md-6">
                                <select name="receive" class="form-control" id="receive">
                                	<option value="0"></option>
                                	@foreach($data['walletList'] as $key)
                                        @if($key->id != $data['walletSend']->id)
    									<option value="{{ $key->id }}">{{ $key->name }}</option>}
                                        @endif
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