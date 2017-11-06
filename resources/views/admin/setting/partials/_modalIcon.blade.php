{{-- modal for setting Icon --}}
	<div class="modal-container">
		@component('admin.widgets.modal')
			@slot('modalClass', 'full-modal')
			@slot('modalId', 'iconModal')
			@slot('modalTitle', 'Choose Icon')
			@slot('modalBody')
				<ul class="nav nav-tabs" style="margin-bottom: 20px;">
					<li class="active" id="iconLink"><a href="#icon" data-toggle="tab">Icon</a></li>
					<li class="" id="uploadIconLink"><a href="#uploadIcon" data-toggle="tab">Upload Icon</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade active in" id="icon">
						@include('admin.setting.partials._iconList')
					</div>
					<div class="tab-pane fade" id="uploadIcon">
						@component('admin.widgets.panel')
							@slot('panelBody')
								<form id="uploadIcon" class="dropzone" method="POST" action="{{route('image.store')}}">
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