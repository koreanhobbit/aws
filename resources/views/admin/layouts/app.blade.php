<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SB Admin 2 | cham11ng') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/timeline.css') }}">

    {{-- dropzone css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.0.1/min/dropzone.min.css">
    {{-- summer note css --}}
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">

    {{-- lightbox --}}
    <link rel="stylesheet" href="{{asset('css/lightbox.css')}}">
     @yield('link')
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <style>
        .dropzone{
            border:dashed;
        }
    </style>
</head>
<body>
    @yield('body')

    <script src="{{ asset("js/app.js") }}"></script>
    <script src="{{ asset("js/Chart.js") }}"></script>
    <script src="{{ asset("js/admin.js") }}"></script>
     {{-- summer note script --}}
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>
    {{-- dropzone js link --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.0.1/min/dropzone.min.js"></script>
    {{-- lightbox js link --}}
   {{--  <script src="{{ asset('js/lightbox.js') }}"></script> --}}
    @yield('script')
</body>
</html>