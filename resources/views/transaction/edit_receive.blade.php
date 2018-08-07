@extends('layouts.layouts')

@section('title') Edit Transaction @endsection

@section('content')
<div class="container">
    <a href="{{ route('transaction.index') }}" title="Back" class="btn btn-primary mb-3">Back</a>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Transaction') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('transaction.editReceive',$transaction['id']) }}" aria-label="{{ __('Edit Transaction') }}">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf

                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-6">
                                <select id="category" class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" name="category" value="{{ old('category') }}">
                                    <option value="">Choose Category</option>
                                    @foreach($categories as $key)
                                        <option @if($key['id']==$transaction->category->id) selected @endif value="{{ $key['id'] }}">{{ $key['name'] }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('category'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>

                            <div class="col-md-6">
                                <input id="amount" type="number" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ $transaction['amount'] }}">

                                @if ($errors->has('amount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" value="{{ $transaction['date'] }}">

                                @if ($errors->has('date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="note" class="col-md-4 col-form-label text-md-right">{{ __('Note (optional)') }}</label>

                            <div class="col-md-6">
                                <textarea id="note" class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}" name="note">{{ $transaction['note'] }}</textarea>

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