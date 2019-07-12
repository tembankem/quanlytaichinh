@extends('layouts.layouts')

@section('title') Create New Spend Categories @endsection

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('category.spendIndex') }}">Spend Category</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create New Spend Category</li>
  </ol>
</nav>
    <a href="{{ route('category.spendIndex') }}" title="Back" class="btn btn-primary mb-3">Back</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add New Spend Category') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('category.addSpend') }}" aria-label="{{ __('Add New Spend Category') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Category Name') }}</label>

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
                            <label for="parent" class="col-md-4 col-form-label text-md-right">{{ __('Parent Category (optional)') }}</label>

                            <div class="col-md-6">
                                <select id="parent" class="form-control{{ $errors->has('parent') ? ' is-invalid' : '' }}" name="parent" value="{{ old('parent') }}">
                                    <option value="0">No Parent</option>
                                    @foreach($data as $key)
                                        <option value="{{ $key['id'] }}">{{ $key['name'] }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('parent'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('parent') }}</strong>
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