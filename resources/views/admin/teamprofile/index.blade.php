@extends('admin.layouts.dashboard')

@section('page_heading', 'Team Profile')
@section('section')
	<div class="row message hidden">
		<h4></h4>
	</div>
	<div class="teamprofile_container">
		@include('admin/teamprofile/partials/_list')
	</div>
@endsection	

@section('script')
	@include('admin.teamprofile.partials._script')
@endsection