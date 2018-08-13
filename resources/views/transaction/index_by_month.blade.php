@extends('layouts.layouts')

@section('title') Transactions in {{ \Carbon\Carbon::parse($month)->format('F-Y') }} @endsection

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Transactions</li>
  </ol>
</nav>

<div class="container">
	<a href="{{ route('transaction.showAddSpend') }}" class="btn btn-warning mb-2" title="Create New Spend Transaction">+ Create New Spend Transaction</a>
	<br>
	<a href="{{ route('transaction.showAddReceive') }}" class="btn btn-primary mb-2" title="Create New Receive Transaction">+ Create New Receive Transaction</a>
	<form method="POST" action="{{ route('transaction.indexByMonth') }}" aria-label="{{ __('Add New Receive Transaction') }}">
        @csrf
        <div class="form-group row">
            <label for="month" class="col-md-2 col-form-label text-md-right">{{ __('Search by Month') }}</label>

            <div class="col-md-2">
                <input id="month" type="month" class="form-control{{ $errors->has('month') ? ' is-invalid' : '' }}" name="month" value="{{ $date }}">

                @if ($errors->has('month'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('month') }}</strong>
                    </span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">
                {{ __('Search') }}
            </button>
        </div>
	</form>
	<a class="btn btn-warning mb-3" href="{{ route('transaction.showCategory') }}" title="Search by Category">Search by Category</a>
	@if(session('success'))
	<div class="alert alert-success">
		{{ session('success') }}
	</div>
	@endif
    @if($transactions->isEmpty())
        <p class="text-center">You don't have any transactions.</p>
    @endif
	<div class="card mb-3">
        <div class="card-header"><i class="fa fa-table"></i> Spend Transactions in {{ \Carbon\Carbon::parse($month)->format('F-Y') }}</div>
    	<div class="card-body">
         	<div class="table-responsive">
	            <table class="table table-bordered" id="spendTransactionTable" width="100%" cellspacing="0">
	              	<thead>
	                	<tr>
	                		<td>No.</td>
	                		<td>Category</td>
	                		<td>From Wallet</td>
	                		<td>Amount</td>
	                		<td>Note</td>
	                		<td>Time</td>
	                		<td></td>
	                		<td></td>
	                	</tr>
	              	</thead>
	              	<tfoot>
	                
	              	</tfoot>
	              	<tbody>
						@php $count = 0 @endphp
	            		@foreach($transactions as $key => $value)
	            		@if($value->type == config('const.spendType'))
						<tr>
							<td>{{ $count += 1 }}</td>
							<td>{{ $value->cat_name }}</td>
							<td>{{ $value->wal_name }}</td>
							<td>+ {{ number_format($value->amount) }} đ</td>
							<td>{{ $value->note }}</td>
							<td>{{ \Carbon\Carbon::parse($value->date)->format('d-m-Y') }}</td>
							<td class="text-center"><a class="btn btn-primary" href="{{ route('transaction.showEditReceive',$value->id) }}" title="Edit">Edit</a></td>
							<td class="text-center"><a class="btn btn-danger" href="{{ route('transaction.deleteReceive',$value->id) }}" title="Delete" onclick="return confirm('Do you want to delete this Transaction?');">Delete</a></td>
						</tr>
						@endif
	            		@endforeach
	              	</tbody>
	            </table>
          	</div>
        </div>
	</div>

	<div class="card mb-3">
        <div class="card-header"><i class="fa fa-table"></i> Receive Transactions in {{ \Carbon\Carbon::parse($month)->format('F-Y') }}</div>
    	<div class="card-body">
         	<div class="table-responsive">
	            <table class="table table-bordered" id="receiveTransactionTable" width="100%" cellspacing="0">
	              	<thead>
	                	<tr>
	                		<td>No.</td>
	                		<td>Category</td>
	                		<td>From Wallet</td>
	                		<td>Amount</td>
	                		<td>Note</td>
	                		<td>Time</td>
	                		<td></td>
	                		<td></td>
	                	</tr>
	              	</thead>
	              	<tfoot>
	                
	              	</tfoot>
	              	<tbody>
						@php $count = 0 @endphp
	            		@foreach($transactions as $key)
	            		@if($value->type == config('const.receiveType'))
						<tr>
							<td>{{ $count += 1 }}</td>
							<td>{{ $value->cat_name }}</td>
							<td>{{ $value->wal_name }}</td>
							<td>+ {{ number_format($value->amount) }} đ</td>
							<td>{{ $value->note }}</td>
							<td>{{ \Carbon\Carbon::parse($value->date)->format('d-m-Y') }}</td>
							<td class="text-center"><a class="btn btn-primary" href="{{ route('transaction.showEditReceive',$value->id) }}" title="Edit">Edit</a></td>
							<td class="text-center"><a class="btn btn-danger" href="{{ route('transaction.deleteReceive',$value->id) }}" title="Delete" onclick="return confirm('Do you want to delete this Transaction?');">Delete</a></td>
						</tr>
						@endif
	            		@endforeach
	              	</tbody>
	            </table>
          	</div>
        </div>
	</div>

	<div class="card mb-3">
        <div class="card-header"><i class="fa fa-table"></i> Money Transfer Between Wallets in {{ \Carbon\Carbon::parse($month)->format('F-Y') }}</div>
    	<div class="card-body">
    		@if($walletTransactions->isEmpty())
                <p class="text-center">You don't have any transfer.</p>
            @endif
         	<div class="table-responsive">
	            <table class="table table-bordered" id="walletTransactionTable" width="100%" cellspacing="0">
	              	<thead>
	                	<tr>
	                		<td>No.</td>
	                		<td>From</td>
	                		<td>To</td>
	                		<td>Exchange</td>
	                		<td>Note</td>
	                		<td>Time</td>
	                		<td></td>
	                		<td></td>
	                	</tr>
	              	</thead>
	              	<tfoot>
	                
	              	</tfoot>
	              	<tbody>
						@php $count = 0 @endphp
	            		@foreach($walletTransactions as $key => $value)
						<tr>
							<td>{{ $count += 1 }}</td>
							<td>{{ $value->wal_name }}</td>
							<td>{{ $value->wal_rec_name }}</td>
							<td>{{ number_format($value->exchange) }} đ</td>
							<td>{{ $value->note }}</td>
							<td>{{ \Carbon\Carbon::parse($value->date)->format('d-m-Y') }}</td>
							<td class="text-center"><a class="btn btn-primary" href="{{ route('wallet.showEditTransfer',$value->id) }}" title="Edit">Edit</a></td>
							<td class="text-center"><a class="btn btn-danger" href="{{ route('wallet.deleteTransfer',$value->id) }}" title="Delete" onclick="return confirm('Do you want to delete this Transfer?');">Delete</a></td>
						</tr>
	            		@endforeach
	              	</tbody>
	            </table>
          	</div>
        </div>
	</div>
</div>

@endsection