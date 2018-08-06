@extends('layouts.layouts')

@section('title') Receive Transaction Categories @endsection

@section('content')
<div class="container">
	<a href="{{ route('category.showAddReceive') }}" title="Add New Receive Category" class="btn btn-primary mb-3">+ Add New Receive Category</a>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Receive Transaction Categories') }}</div>
				@if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-body">
                    <ul class="">
                    	@foreach($data as $key)
                    	@if($key['level'] == 1)
                    	<li>
                    		<a href="{{ route('category.showEditReceive',$key['id']) }}" title="{{ $key['name'] }}">{{ $key['name'] }}</a>
                    		<ul class="">
                    			@foreach($data as $key2)
                    			@if($key2['parent_id'] == $key['id'])
                    			<li>
                    				<a href="{{ route('category.showEditReceive',$key2['id']) }}" title="{{ $key2['name'] }}">{{ $key2['name'] }}</a>
                    				<ul class="">
                    					@foreach($data as $key3)
                    					@if($key3['parent_id'] == $key2['id'])
                    					<li>
                    						<a href="{{ route('category.showEditReceive',$key3['id']) }}" title="{{ $key3['name'] }}">{{ $key3['name'] }}</a>
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