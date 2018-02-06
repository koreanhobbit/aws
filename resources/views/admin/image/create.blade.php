@extends('admin.layouts.dashboard')
@section('page_heading', 'Images')
@section('section')
<div class="row">
	<div class="col-md-12">
		@component('admin.widgets.panel')
			@slot('panelTitle1', 'Upload New Images')
			@slot('panelBody')
				<form action="{{route('image.store')}}" class="dropzone" method="POST" id="addImage">
					{{ csrf_field() }}
					<div class="fallback">
		    			<input name="file" type="file" multiple />
		  			</div>
					<h3 class="text-center">Drop your image inside the box or click to add the link</h3>
				</form>
				<h4 class="error-message btn-warning"></h4>
			@endslot
		@endcomponent
	</div>
</div>
@endsection

@section('script')
	<script>
		//setting and calling the dropzone image
        Dropzone.options.addImage = {
            paramName: 'file',
            maxFilesize: 2, // MB
            dictDefaultMessage: 'Drag an image here to upload, or click to select one',
            acceptedFiles: 'image/*',
            uploadMultiple: true,
            successmultiple: function(file,response) {
                window.location = "/admin/image";
            }
        };
	</script>
@endsection