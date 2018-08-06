@extends('layouts.layouts')

@section('title')Edit Category @endsection

@section('content')
<div class="container">
    <a href="@if($category['type'] == 1) {{ route('category.spendIndex') }} @else {{ route('category.receiveIndex') }} @endif" title="Back" class="btn btn-primary mb-3">Back</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Category') }}</div>

                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('category.edit',$category['id']) }}" aria-label="{{ __('Edit Category') }}">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Category Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $category['name'] }}" required autofocus>

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
                                        <option @if($key['id'] == $category['parent_id']) selected @endif value="{{ $key['id'] }}">{{ $key['name'] }}</option>
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