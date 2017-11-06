@extends('admin.layouts.dashboard')
@section('page_heading', 'Category')
@section('section')
	<div class="row">
		<div class="alert" id="message">
			<h4></h4>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div id="form">	
				<h4>Add New Category</h4>
				 <div class="form-group">
				 	{{ csrf_field() }}
				    <label for="categoryName" class="control-label">Name</label>
					<input type="text" class="form-control" name="categoryName" id="categoryName" placeholder="Name">
				 </div>
				 <div class="form-group">
				    <label for="categorySlug" class="control-label">Slug</label>
					<input type="text" class="form-control" name="categorySlug" id="categorySlug" placeholder="Slug">
				 </div>
				 <input class="btn btn-primary" value="Add New Category" id="addCategoryBtn">
			 </div>
		</div>
		<div class="list_container col-md-8">
			@component('admin.widgets.panel')
				@slot('panelTitle1', 'Category List')
				@slot('panelBody')
					@include('admin.category.partials._list')
				@endslot
			@endcomponent
		</div>
	</div>
@endsection
@section('script')	
	<script>
		$(document).ready(function() {
			removeMessage();
			// function for clicking pagenation
			$('body').on('click', '.pagination a', function(e) {
				e.preventDefault();
				var url = $(this).attr('href');
				ajaxPagination(url);
			});

			//function ajax for pagination
			function ajaxPagination(url) {
				$.ajax({
					url: url,
					success: function(data) {
						$('.list_container').html(data);
					},
				});
			}

			{{-- auto populate slug from name value input --}}
			$('#categoryName').on('keypress blur', function () {
				var val = $(this).val();
				val = val.replace(/\s+/g, '-').toLowerCase();
				$('#categorySlug').val(val);
			});


			//call the edit ajax
			editCategory();

			//call the delete ajax
			deleteCategory();
			// ajax for store category
			$('#addCategoryBtn').click(function() {
				$.ajax({
					type:"POST",
					url: "{{ route('category.store') }}",
					data: {
						'_token': $('input[name=_token]').val(),
						'categoryName': $('input[name=categoryName]').val(),
						'categorySlug': $('input[name=categorySlug]').val()
					},
					beforeSend: function(data){
						//remove error message
						removeMessage();
					},
					success: function(data) {
						$('.list_container').html(data);
						
						//remove values in inputs
						$('#categoryName').val('');
						$('#categorySlug').val('');

						//put success message
						$('#message').addClass('alert-success');
						$('#message h4').text('Category added successfully!');
						$('#message').removeClass('hidden');

						//call the edit category function
						editCategory();

						//call the delete category
						deleteCategory();

					},
					error:function(data) {
						var errors = data.responseJSON.errors;
						if(errors != null) {
							$('#message').removeClass('hidden');
							$('#message').addClass('alert-danger');
	 						for (data in errors) {
								$('#message h4').html(errors[data]);
							}
						}
					}  
				});
			});

			//ajax for editing the category
			function editCategory() {
				$('.categoryEditBtn').click(function() {
					dataUrl = $(this).data('url');
					linkEdit = $(this);
					$.ajax({
						type: "GET",
						url: dataUrl,
						data: {
							'_token': $('input[name=_token]').val(),
						},
						beforeSend: function() {
							//remove error message
							removeMessage();

							// create n show loader
							$('#form').hide();
							$('#form').parent().append("<div class='loader' style='display:none;'></div>");
							$('.loader').fadeIn('slow');
						},
						success: function(data) {
							//make var for response data
							dataUrl = data.dataUrl;

							// destroy n hide loader
							$('.loader').fadeOut('slow');
							$('.loader').remove();

							//change attrs to edit
							$('#form h4').text('Edit Category');
							$('#addCategoryBtn').hide();
							if($('#form').find('.submitEditCategoryBtn').length > 0) {
								$('.submitEditCategoryBtn').remove();
								$('#cancelEditCategoryBtn').remove();

							}

							$('#form').append("<div class='row'><div class='col-sm-6'><input class='btn btn-primary btn-sm submitEditCategoryBtn' value='Edit Category' data-url='" + dataUrl + "'></div><div class='col-sm-6'><input class='btn btn-primary btn-sm' value='Cancel' id='cancelEditCategoryBtn'></div></div>");

							//show edit form
							function showForm() {
								$('#form').slideDown('slow');
							}

							setTimeout(showForm, 100);

							//fill the inputs form for editing
							$('#categoryName').val(data.categoryName);
							$('#categorySlug').val(data.categorySlug);

							// call the function for submit edit button
							submitEditCategory(linkEdit);
							cancelEdit();
						},
						error: function(data) {
							//action when errors r happened
						},
					});
				});
			}

			//ajax for updating category
			function submitEditCategory(linkEdit) {
				$('.submitEditCategoryBtn').click(function() {
					dataUrlUpdate = $(this).data('url');
					var link = $(this);
					//call the ajax
					$.ajax({
						type: "PUT",
						url: dataUrlUpdate,
						data: {
							'_token': $('input[name=_token]').val(),
							'categoryName': $('input[name=categoryName]').val(),
							'categorySlug': $('input[name=categorySlug]').val()
						},
						beforeSend: function(data) {
							//remove error message
							removeMessage();
						},
						success: function(data) {
							$('.list_container').html(data);

							//add success message
							$('#message').removeClass('hidden');
							$('#message').addClass('alert-success');
							$('#message h4').text('Category edited successfully!');

							//change attrs to add new category
							changeToAdd(link);
							
						},
						error: function(data) {
							var errors = data.responseJSON.errors;
							if(errors != null) {
								$('#message').removeClass('hidden');
								$('#message').addClass('alert-danger');
	 							for (data in errors) {
									$('#message h4').html(errors[data]);
								}
							}
						},
					});
				}); 
			}

			//function for canceling editing
			function cancelEdit() {
				$('#cancelEditCategoryBtn').click(function() {
					var link = $(this);
					//remove messages
					removeMessage();
					//change attrs
					changeToAdd(link);

					
				}); 
			}

			//ajax for deleting category
			function deleteCategory() {
				$('.categoryDeleteBtn').click(function() {
					dataUrl = $(this).data('url');
					// row = $(this).closest('tr');
					$.ajax({
						type: "DELETE",
						url: dataUrl,
						data: {
							'_token': $('input[name=_token]').val(),
						},
						
						beforeSend:function() {
							//remove message
							removeMessage();
						},
						success: function(data) {
							$('.list_container').html(data);

							
							deleteCategory()

							//add message
							$('#message').removeClass('hidden');
							$('#message').addClass('alert-success');
							$('#message h4').text('The category deleted successfully!');
						},
					});
				});
			}

			// function for removing message
			function removeMessage() {
				$('#message').addClass('hidden');
				if ($('#message').hasClass('alert-danger')) {
					$('#message').removeClass('alert-danger');
				}
				if ($('#message').hasClass('alert-success')) {
					$('#message').removeClass('alert-success');	
				}

				$('#message h4').text('');
			}

			//function change attributes to edit
			function changeToAdd(link) {
				//hide the form 
				$('#form').hide();

				$('#form h4').text('Add New Category');
				$('input[name=categoryName]').val('');
				$('input[name=categorySlug]').val('');
				link.closest('.row').remove();
				$('#addCategoryBtn').show();

				//show the form
				$('#form').slideDown('slow');
			}

		});
	</script>
@endsection