@extends('admin/layouts.dashboard')

@section('page_heading', 'Portfolio')

@section('section')
	<div class="portfolio_container">
		@include('admin/portfolio/partials/_list')
	</div>
	@include('admin.portfolio.partials._modal')
@endsection

@section('script')
	@include('admin.portfolio.partials._script')
@endsection