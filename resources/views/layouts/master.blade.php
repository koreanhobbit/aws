<!DOCTYPE html>
<html lang="en">
	@include('includes._head')
	<body id="page-top" class="index">
		@include('includes._navigation')
		@include('includes._header')
		@yield('content')
		@yield('modals')
		@include('includes._footer')
		@yield('script')
		@include('includes._chat')
	</body>
</html>