@extends('layouts.layouts')

@section('title') Show Transactions By Category @endsection

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('transaction.index') }}">Transactions</a></li>
    <li class="breadcrumb-item active" aria-current="page">Choose Category</li>
  </ol>
</nav>
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <p class="text-center">Choose one category</p>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Spend Transaction Categories') }}</div>
                <div class="card-body">
                    @if($spendCategories->isEmpty())
                        <p class="text-center">You don't have any spend category. <a href="{{ route('category.showAddSpend') }}" title="Create New Category">Create one!</a></p>
                    @endif
                    <ul class="">
                    	@foreach($spendCategories as $key)
                    	@if($key['level'] == 1)
                    	<li>
                    		<a href="{{ route('transaction.showTransactionsByCategory',$key['id']) }}" title="{{ $key['name'] }}">{{ $key['name'] }}</a>
                    		<ul class="">
                    			@foreach($spendCategories as $key2)
                    			@if($key2['parent_id'] == $key['id'])
                    			<li>
                    				<a href="{{route('transaction.showTransactionsByCategory',$key2['id']) }}" title="{{ $key2['name'] }}">{{ $key2['name'] }}</a>
                    				<ul class="">
                    					@foreach($spendCategories as $key3)
                    					@if($key3['parent_id'] == $key2['id'])
                    					<li>
                    						<a href="{{route('transaction.showTransactionsByCategory',$key3['id']) }}" title="{{ $key3['name'] }}">{{ $key3['name'] }}</a>
                    					</li>
                    					@endif
                    					@endforeach
                    				</ul>
                    			</li>
                    			@endif
                    			@endforeach
                    		</ul>
                    	</li>
                    	@endif
                    	@endforeach()
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Receive Transaction Categories') }}</div>
                <div class="card-body">
                    @if($receiveCategories->isEmpty())
                        <p class="text-center">You don't have any receive category. <a href="{{ route('category.showAddReceive') }}" title="Create New Category">Create one!</a></p>
                    @endif
                    <ul class="">
                        @foreach($receiveCategories as $key)
                        @if($key['level'] == 1)
                        <li>
                            <a href="{{ route('transaction.showTransactionsByCategory',$key['id']) }}" title="{{ $key['name'] }}">{{ $key['name'] }}</a>
                            <ul class="">
                                @foreach($receiveCategories as $key2)
                                @if($key2['parent_id'] == $key['id'])
                                <li>
                                    <a href="{{ route('transaction.showTransactionsByCategory',$key2['id']) }}" title="{{ $key2['name'] }}">{{ $key2['name'] }}</a>
                                    <ul class="">
                                        @foreach($receiveCategories as $key3)
                                        @if($key3['parent_id'] == $key2['id'])
                                        <li>
                                            <a href="{{ route('transaction.showTransactionsByCategory',$key3['id']) }}" title="{{ $key3['name'] }}">{{ $key3['name'] }}</a>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </li>
                        @endif
                        @endforeach()
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection