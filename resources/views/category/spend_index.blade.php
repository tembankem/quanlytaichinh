@extends('layouts.layouts')

@section('title') Spend Transaction Categories @endsection

@section('content')
<div class="container">
	<a href="{{ route('category.showAddSpend') }}" title="Add New Spend Category" class="btn btn-primary mb-3">+ Add New Spend Category</a>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Spend Transaction Categories') }}</div>
				@if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-body">
                    @if($data->isEmpty())
                        <p class="text-center">You don't have any category. <a href="{{ route('category.showAddSpend') }}" title="Create New Category">Create one!</a></p>
                    @endif
                    <ul class="">
                    	@foreach($data as $key)
                    	@if($key['level'] == config('const.rootLevel'))
                    	<li>
                    		<a href="{{ route('category.showEditSpend',$key['id']) }}" title="{{ $key['name'] }}">{{ $key['name'] }}</a>
                    		<ul class="">
                    			@foreach($data as $key2)
                    			@if($key2['parent_id'] == $key['id'])
                    			<li>
                    				<a href="{{ route('category.showEditSpend',$key2['id']) }}" title="{{ $key2['name'] }}">{{ $key2['name'] }}</a>
                    				<ul class="">
                    					@foreach($data as $key3)
                    					@if($key3['parent_id'] == $key2['id'])
                    					<li>
                    						<a href="{{ route('category.showEditSpend',$key3['id']) }}" title="{{ $key3['name'] }}">{{ $key3['name'] }}</a>
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