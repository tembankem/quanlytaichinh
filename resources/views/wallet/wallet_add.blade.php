@extends('layouts.layouts')

@section('title') Create New Wallet @endsection

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('wallet.index') }}">Wallet</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create New Wallet</li>
  </ol>
</nav>
<div class="container">
    <a href= "{{ route('wallet.index') }}" title="Back" class="btn btn-primary mb-3">Back</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add New Wallet') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('wallet.add') }}" aria-label="{{ __('Add New Wallet') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Wallet Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="money" class="col-md-4 col-form-label text-md-right">{{ __('Money') }}</label>

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
                                    {{ __('Submit') }}
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