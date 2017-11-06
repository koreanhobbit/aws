{{-- modal for teamprofile image --}}
	<div class="modal-container">
		@component('admin.widgets.modal')
			@slot('modalClass', 'full-modal')
			@slot('modalId', 'teamprofileModal')
			@slot('modalTitle', 'Choose Profile Image')
			@slot('modalBody')
				<ul class="nav nav-tabs" style="margin-bottom: 20px;">
					<li class="active" id="profileImageLink"><a href="#profileImage" data-toggle="tab">Profile Image</a></li>
					<li class="" id="uploadImageLink"><a href="#uploadImage" data-toggle="tab">Upload Image</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade active in" id="profileImage">
						@include('admin.teamprofile.partials._profileimglist')
					</div>
					<div class="tab-pane fade" id="uploadImage">
						@component('admin.widgets.panel')
							@slot('panelBody')
								<form id="uploadImageForm" class="dropzone" method="POST" action="{{route('image.store')}}">
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