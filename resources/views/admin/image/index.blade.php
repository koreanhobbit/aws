@extends('admin.layouts.dashboard')
@section('page_heading', 'Images')
@section('section')
	<div class="col-sm-12">
		@if(!count($images))
			<div class="alert alert-info text-center">
				<h1>There is no image</h1>
			</div>
		@else
			@if(session()->has('message'))
				<div class="alert alert-info">
					<h4>{{ session()->get('message') }}</h4>
				</div>
			@endif
			
			<div class="row">
				<div class="col-md-12">
					@component('admin.widgets.panel')
						@slot('panelTitle1', 'Images List')
						@slot('panelBody')
							<div class="row ">
								@foreach($images as $image)
									<div class="col-md-2 col-sm-6">
										<div class="thumbnail">
											{{ csrf_field() }}
											<a href="javascript:" type="button" data-toggle="modal" data-target="{{ '#'.'img-details' }}" class="image-thum-link" data-id="{{ $image->id }}">
												<img src="{{ url($image->thumbnail->location) }}" alt="" class="img-responsive thumbnail-img">
											</a>
										</div>
									</div>
								@endforeach
								@component('admin.widgets.modal')
									@slot('modalClass', 'full-modal')
									@slot('modalId', 'img-details')
									@slot('modalTitle','Image Details')
									@slot('modalBody')
										<div class="row">
											<div class="col-md-7">
												@component('admin.widgets.panel')
													@slot('panelBody')
														<div class="thumbnail">
															<img src="" alt="" class="img-responsive img-thumbnail" id="img-in-details">
														</div>
													@endslot
													@slot('panelFooter')
														@slot('panelFooterClass', 'text-center')
														<form action="" method="POST" id="form-destroy">	
														{{ method_field('DELETE') }}
														{{ csrf_field() }}
															<button class="btn btn-primary" type="submit" onclick="return confirm('Are you sure?')">Delete Permanently</button>
														</form>
													@endslot
												@endcomponent
											</div>
											<div class="col-md-5">
												<div class="row">
													@component('admin.widgets.panel')
														@slot('panelBody')	
														<div class="table-responsive">
															<table class="table table-striped">
																<tr>
																	<td>
																		File name
																	</td>
																	<td>
																		:
																	</td>
																	<td id="img-name">
																	</td>
																</tr>
																<tr>
																	<td>
																		File type
																	</td>
																	<td>
																		:
																	</td>
																	<td id="img-type">
																	</td>
																</tr>
																<tr>
																	<td>
																		Uploaded on
																	</td>
																	<td>
																		:
																	</td>
																	<td id="img-uploaded-at">
																	</td>
																</tr>
																<tr>
																	<td>
																		Last edited on
																	</td>
																	<td>
																		:
																	</td>
																	<td id="img-updated-at">
																	</td>
																</tr>
																<tr>
																	<td>
																		Uploaded by
																	</td>
																	<td>
																		:
																	</td>
																	<td id="img-author">
																	</td>
																</tr>
																<tr>
																	<td>
																		Uploaded to
																	</td>
																	<td>
																		:
																	</td>
																	<td id="img-uploaded-to">
																	</td>
																</tr>
															</table>
															</div>
														@endslot
													@endcomponent
												</div>
											</div>
										</div>
									@endslot
								@endcomponent
							</div>
						@endslot
					@endcomponent
				</div>
			</div>
		@endif
	</div>
@endsection

@section('script')
	<script>
		$(document).ready(function() {
			$('.image-thum-link').on('click', function () {
				$('#img-in-details').hide();
				id = $(this).data('id');
				$.ajax({
					type: "POST",
					url: "{{ route('image.modal') }}",
					data: {
						'_token': $('input[name=_token]').val(),
						'id': id
					},
					success: function (data){
						imageId = data.id;
						routeAdmin = "{{ url('admin') }}";
						storageUrl = "{{ url('storage/images/thumbnail/') }}";
						var created_at = data.created_at.date;
						var updated_at = data.updated_at.date;
						created_at = created_at.substring(0, created_at.indexOf('.'));
						updated_at = updated_at.substring(0, updated_at.indexOf('.'));
						$('#img-in-details').attr("src", storageUrl + "/" + data.name);
						$('#img-in-details').show();
						$('#form-destroy').attr("action", data.action);
						$('#img-name').text(data.name);
						$('#img-type').text(data.type);
						$('#img-uploaded-at').text(created_at);
						$('#img-updated-at').text(updated_at);
						$('#img-author').text(data.author);
						$('#img-uploaded-to').text(data.imageable_type);
					},
				});
			});
		});
	</script>
@endsection