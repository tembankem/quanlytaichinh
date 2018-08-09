@extends('layouts.layouts')

@section('title') Transactions in {{ $catName }} @endsection

@section('content')

<div class="container">
	<a href="{{ route('transaction.index') }}" title="Back" class="btn btn-primary mb-3">Back</a>
	@if(session('success'))
	<div class="alert alert-success">
		{{ session('success') }}
	</div>
	@endif
    @if($transactions->isEmpty())
        <p class="text-center">You don't have any transactions in {{ $catName }}.</p>
    @endif
    @if($catType == config('const.spendType'))
	<div class="card mb-3">
        <div class="card-header"><i class="fa fa-table"></i> Spend Transactions in {{ $catName }}</div>
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
						<tr>
							<td>{{ $count += 1 }}</td>
							<td>{{ $catName }}</td>
							<td>{{ $value->wal_name }}</td>
							<td>- {{ number_format($value->amount) }} đ</td>
							<td>{{ $value->note }}</td>
							<td>{{ \Carbon\Carbon::parse($value->date)->format('d-m-Y') }}</td>
							<td class="text-center"><a class="btn btn-primary" href="{{ route('transaction.showEditSpend',$value->id) }}" title="Edit">Edit</a></td>
							<td class="text-center"><a class="btn btn-danger" href="{{ route('transaction.deleteSpend',$value->id) }}" title="Delete" onclick="return confirm('Do you want to delete this Transaction?');">Delete</a></td>
						</tr>
	            		@endforeach
	              	</tbody>
	            </table>
          	</div>
        </div>
	</div>
	@else
	<div class="card mb-3">
        <div class="card-header"><i class="fa fa-table"></i> Receive Transactions in {{ $catName }}</div>
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
	            		@foreach($transactions as $key => $value)
						<tr>
							<td>{{ $count += 1 }}</td>
							<td>{{ $catName }}</td>
							<td>{{ $value->wal_name }}</td>
							<td>- {{ number_format($value->amount) }} đ</td>
							<td>{{ $value->note }}</td>
							<td>{{ \Carbon\Carbon::parse($value->date)->format('d-m-Y') }}</td>
							<td class="text-center"><a class="btn btn-primary" href="{{ route('transaction.showEditSpend',$value->id) }}" title="Edit">Edit</a></td>
							<td class="text-center"><a class="btn btn-danger" href="{{ route('transaction.deleteSpend',$value->id) }}" title="Delete" onclick="return confirm('Do you want to delete this Transaction?');">Delete</a></td>
						</tr>
	            		@endforeach
	              	</tbody>
	            </table>
          	</div>
        </div>
	</div>
	@endif
</div>

@endsection