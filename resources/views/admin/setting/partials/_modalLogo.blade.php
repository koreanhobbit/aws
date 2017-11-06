{{-- modal for setting Logo --}}
	<div class="modal-container">
		@component('admin.widgets.modal')
			@slot('modalClass', 'full-modal')
			@slot('modalId', 'logoModal')
			@slot('modalTitle', 'Choose Logo Image')
			@slot('modalBody')
				<ul class="nav nav-tabs" style="margin-bottom: 20px;">
					<li class="active" id="logoImageLink"><a href="#logoImage" data-toggle="tab">Logo Image</a></li>
					<li class="" id="uploadLogoImageLink"><a href="#uploadLogoImage" data-toggle="tab">Upload Logo Image</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade active in" id="logoImage">
						@include('admin.setting.partials._logoList')
					</div>
					<div class="tab-pane fade" id="uploadLogoImage">
						@component('admin.widgets.panel')
							@slot('panelBody')
								<form id="uploadLogoImage" class="dropzone" method="POST" action="{{route('image.store')}}">
									{{ csrf_field() }}
									<div class="fallback">
						    			<input name="file" type="file" multiple />
						  			</div>
									<h3 class="text-center">Drop your image inside the box or click to add the link</h3>
								</form>
							@endslot
						@endcomponent
					</div>
				</div>
			@endslot
		@endcomponent
	</div>