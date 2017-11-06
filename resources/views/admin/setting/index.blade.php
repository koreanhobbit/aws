@extends('admin.layouts.dashboard')
@section('page_heading', 'Setting')

@section('section')
	{{ csrf_field() }}
	@component('admin.widgets.panel')
		@slot('panelTitle', 'Control Panel')
		@slot('panelBody')
			<div class="setting_container">
				@include('admin.setting.partials._general')
			</div>
		@endslot
	@endcomponent

	{{-- include modal for logo --}}
	@include('admin.setting.partials._modalLogo')

	{{-- Include modal for icon --}}
	@include('admin.setting.partials._modalIcon')
@endsection

@include('admin.setting.partials._script')