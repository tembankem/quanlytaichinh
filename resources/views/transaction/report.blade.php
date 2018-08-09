@extends('layouts.layouts')

@section('title') Transactions This Month @endsection

@section('content')

<div class="container">
	<form method="POST" action="{{ route('transaction.reportByMonth') }}" aria-label="{{ __('Search Report By Month') }}">
        @csrf
        <div class="form-group row">
            <label for="month" class="col-md-2 col-form-label text-md-right">{{ __('Search by Month') }}</label>

            <div class="col-md-2">
                <input id="month" type="month" class="form-control{{ $errors->has('month') ? ' is-invalid' : '' }}" name="month" value="">

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
	@if(session('success'))
	<div class="alert alert-success">
		{{ session('success') }}
	</div>
	@endif
    @if($categories->isEmpty())
        <p class="text-center">You don't have any transactions.</p>
    @endif
    @php $totalSpend=0; $totalReceive=0; @endphp
	<div class="card mb-3">
        <div class="card-header"><i class="fa fa-table"></i> Total Money Spend This Month</div>
    	<div class="card-body">
         	<div class="table-responsive">
	            <table class="table table-bordered" id="reportSpendTable" width="100%" cellspacing="0">
	              	<thead>
	                	<tr>
	                		<td>No.</td>
	                		<td>Category</td>
	                		<td>Total Amount</td>
	                	</tr>
	              	</thead>
	              	<tfoot>
	                
	              	</tfoot>
	              	<tbody>
						@php $count = 0 @endphp
	            		@foreach($categories as $key => $value)
	            		@if($value->type == config('const.spendType'))
						<tr>
							<td>{{ $count += 1 }}</td>
							<td>{{ $value->name }}</td>
							<td>- {{ number_format($value->sum) }} đ</td>
						</tr>
						@php $totalSpend += $value->sum @endphp
						@endif
	            		@endforeach
	              	</tbody>
	            </table>
          	</div>
        </div>
	</div>

	<div class="card mb-3">
        <div class="card-header"><i class="fa fa-table"></i> Total Money Receive This Month</div>
    	<div class="card-body">
         	<div class="table-responsive">
	            <table class="table table-bordered" id="reportReceiveTable" width="100%" cellspacing="0">
	              	<thead>
	                	<tr>
	                		<td>No.</td>
	                		<td>Category</td>
	                		<td>Total Amount</td>
	                	</tr>
	              	</thead>
	              	<tfoot>
	                
	              	</tfoot>
	              	<tbody>
						@php $count = 0 @endphp
	            		@foreach($categories as $key => $value)
	            		@if($value->type == config('const.receiveType'))
						<tr>
							<td>{{ $count += 1 }}</td>
							<td>{{ $value->name }}</td>
							<td>+ {{ number_format($value->sum) }} đ</td>
						</tr>
						@php $totalReceive += $value->sum @endphp
						@endif
	            		@endforeach
	              	</tbody>
	            </table>
          	</div>
        </div>
	</div>
	<div class="form-group row">
		<label for="balance" class="col-md-2 col-form-label text-md-right">Balance This Month</label>
		<div class="col-md-2">
			<input type="text" name="balance" class="form-control" value="{{ number_format($totalReceive - $totalSpend) }} đ" disabled="disabled">
		</div>
	</div>
</div>

@endsection