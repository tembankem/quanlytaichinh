@extends('layouts.layouts')

@section('title') Wallet @endsection

@section('content')

<div class="mb-2">
<a href="{{ route('wallet.showAdd') }}" title="Add New Wallet" class="btn btn-primary">+ Create New Wallet</a>
</div>

<div class="mb-2">
	<a class="btn btn-warning" href="{{ route('wallet.showTransfer') }}" title="Transfer Money">Transfer Money Between Wallets</a>
</div>

<div class="container">
    <div class="card mb-3">
		@if(session('success'))
		<div class="alert alert-success">
			{{ session('success') }}
		</div>
		@endif
        
        <div class="card-header"><i class="fa fa-table"></i> Wallets</div>
    	<div class="card-body">
         	<div class="table-responsive">
	            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	              	<thead>
	                	<tr>
	                		<td>No.</td>
	                		<td>Wallet Name</td>
	                		<td>Balance</td>
	                		<td></td>
	                		<td></td>
	                	</tr>
	              	</thead>
	              	<tfoot>
	                
	              	</tfoot>
	              	<tbody>
						@php $count = 0 @endphp
	            		@foreach($data as $key)
						<tr>
							<td>{{ $count += 1 }}</td>
							<td>{{ $key['name'] }}</td>
							<td>{{ number_format($key['balance']) }} VND</td>
							<td class="text-center"><a class="btn btn-primary" href="/wallet/edit/{{ $key['id'] }}" title="Edit">Edit</a></td>
							<td class="text-center"><a class="btn btn-danger" href="#" title="Delete" onclick="return confirm('Do you want to delete {{ $key['name'] }} Wallet?');">Delete</a></td>
						</tr>
	            		@endforeach
	              	</tbody>
	            </table>
          	</div>
        </div>
	</div>
</div>

@endsection