<script>
	$(document).ready(function() {
		clearMessage();
		//calling button function portfolio
		editButton();
		addPortfolio();
		deleteBtn();
		paginationLink();

//add portfolio
		//add Portfolio action function  
		function addPortfolio() {
			$('#addPortfolio').click(function(event) {
				var url = $(this).data('url');
				var urlstore = $(this).data('urlstore');

				//ajax function for add portfolio
				$.ajax({
					url:url,
					success: function(data) {
						$('.portfolio_container').html(data);
						makeSummernote();
						autoSlug();
						chooseFeaturedImage();
						chooseGalleryImages();
						clickSubmitPortfolio(urlstore);
						addPortfolio();

						Dropzone.autoDiscovery = false;

						//add feature image pressed
						$('#addFeaturedImage').on('click', function() {
							var urlfi = $(this).data('urlfi');
							var urlgi = $(this).data('urlgi');
							Dropzone.autoDiscovery = false;
							//configure the logo dropzone
							$("form#featuredImageDz").dropzone({
								acceptedFiles: "image/*",
								addRemoveLinks: true,
								uploadMultiple: true,
								successmultiple: function(file, response) {
									//update featured image list
									$.ajax({
										type:"POST",
										url:urlfi,
										data:{
											'_token': $('input[name=_token]').val(),
										},
										success: function(data) {
											$('#featuredImageTab').html(data);
											$('#featuredImageTab').addClass('active in');
											$('#uploadFeaturedImageTab').removeClass('active in');
											$('#featuredImageList').addClass('active');
											$('#uploadFeaturedImageList').removeClass('active');
											chooseFeaturedImage();
										},
									});


									//update gallery image list
									$.ajax({
										type:"POST",
										url:urlgi,
										data:{
											'_token': $('input[name=_token]').val(),
										},
										success: function(data) {
											$('#listGalleryImageTab').html(data);
											$('#listGalleryImageTab').addClass('active in');
											$('#uploadGalleryImageTab').removeClass('active in');
											$('#listGalleryImage').addClass('active');
											$('#uploadGalleryImage').removeClass('active');
											chooseGalleryImages();
										},
									});
								},
							});
						});


						//add gallery images pressed
						$('#addGalleryImages').on('click', function() {
							Dropzone.autoDiscovery = false;
							var urlfi = $(this).data('urlfi');
							var urlgi = $(this).data('urlgi');
							

							//configure the logo dropzone
							$("form#galleryImagesDz").dropzone({
								acceptedFiles: "image/*",
								addRemoveLinks: true,
								uploadMultiple: true,
								successmultiple: function(file, response) {
									//update featured image list
									$.ajax({
										type:"POST",
										url:urlfi,
										data:{
											'_token': $('input[name=_token]').val(),
										},
										success: function(data) {
											$('#featuredImageTab').html(data);
											$('#featuredImageTab').addClass('active in');
											$('#uploadFeaturedImageTab').removeClass('active in');
											$('#featuredImageList').addClass('active');
											$('#uploadFeaturedImageList').removeClass('active');
											chooseFeaturedImage();
										},
									});


									//update gallery image list
									$.ajax({
										type:"POST",
										url:urlgi,
										data:{
											'_token': $('input[name=_token]').val(),
										},
										success: function(data) {
											$('#listGalleryImageTab').html(data);
											$('#listGalleryImageTab').addClass('active in');
											$('#uploadGalleryImageTab').removeClass('active in');
											$('#listGalleryImage').addClass('active');
											$('#uploadGalleryImage').removeClass('active');
											chooseGalleryImages();
										},
									});

								},
							});
						});
					},
				});
				clearMessage();
			});
		}



// delete portfolio
		//deleteBtn action function 
		function deleteBtn() {
			$('.deleteBtn').on('click', function() {
				clearMessage();
				var url = $(this).data('url');
				$.ajax({
					type:'DELETE',
					url:url,
					data: {
						'_token' : $('input[name=_token]').val(),
					},
					success: function(data) {
						$('.portfolio_container').html(data);
						//calling button function portfolio
						editButton();
						addPortfolio();
						deleteBtn();
						paginationLink();
					},
				}); 
			});
		}	

//create portfolio section

		//function for making summernote textarea
		function makeSummernote() {
			$("#descriptionPortfolio").summernote({
				minHeight: 300
			});
		}

		//function auto populate slug from title value input
		function autoSlug() {
			$('#titlePortfolio').on('keypress blur', function() {
				var val = $(this).val();
				val = val.replace(/\s+/g, '-').toLowerCase();
				$('#slugPortfolio').val(val);
			});
		}

		//function choose gallery images
		function chooseGalleryImages() {
			$('.portfolio-gallery-image').on('click', function() {
				$(this).parent().toggleClass('selected');
			});

			$('#addGalleryBtn').click(function() {
				if($('.gallerydisplay').length) {
					$.each($('.selected'), function(index, value) {
						selected = $(this).children().data('id');
						selfSelected = $(this);
						$.each($('.gallerydisplay'), function() {
							if(selected == $(this).data('id')) {
								selfSelected.addClass('doubleData');
							}
						});
						if(!selfSelected.hasClass('doubleData')) {
							$('#gallerycontainer').append("<div class='thumbnail col-sm-6 gallerydisplay' data-id='" + $(this).children().data('id') + "'><img src='" + $(this).children().data('name') + "' class='img-responsive gal-img img-thumbnail'><div class='remove-img'><i class='fa fa-remove'></i></div> <input type='hidden' name='galleryimg[" + $(this).children().data('id') + "]' value='" + $(this).children().data('id') + "'> </div>");
						}
					});
				}

				if(!$('.gallerydisplay').length) {
					$.each($('.selected'), function(index, value) {
						$('#gallerycontainer').append("<div class='thumbnail col-sm-6 gallerydisplay' data-id='" + $(this).children().data('id') + "'><img src='" + $(this).children().data('name') + "' class='img-responsive gal-img img-thumbnail'><div class='remove-img'><i class='fa fa-remove'></i></div> <input type='hidden' name='galleryimg[" + $(this).children().data('id') + "]' value='" + $(this).children().data('id') + "'> </div>");
					});
				}

				//remove the selected class
				removeClass();
				removeGalleryImages();
			});
		}

		removeGalleryImages();

		//remove gallery images function 
		function removeGalleryImages() {
			$('.gal-img, .remove-img').click(function(e) {
				e.preventDefault();
				$(this).parent().remove();
			});
		}

		// remove the selected class for gallery images
		function removeClass() {
			if($('.portfolio-gallery-image').parent().hasClass('selected')) {
				$('.portfolio-gallery-image').parent().removeClass('selected');
			}

			if($('.portfolio-gallery-image').parent().hasClass('doubleData')) {
				$('.portfolio-gallery-image').parent().removeClass('doubleData');
			}
		}

		//function for portfolio create portfolio featuredimage
		function chooseFeaturedImage() {
			$('.removeFeaturedImage').hide();
			$('.portfolio-featured-image').on('click', function() {
				var name = $(this).data('name');
				
				var id = $(this).data('id');
				$('#addFeaturedImage').hide();
				$('.removeFeaturedImage a').attr('data-id',id)
				$('.removeFeaturedImage img').attr('src',name);
				$('.removeFeaturedImage').show();
				$('.submitBtn').attr('data-id', id);
			});

			$('.removeFeaturedImage a').on('click', function() {
				$('.submitBtn').attr('data-id', '');
				$(this).parent().slideUp('slow', function() {
					setTimeout(function() {
						$('#addFeaturedImage').slideDown('slow');
					}, 500);
				});
			});
		}

		function clickSubmitPortfolio(url) {
			$('.submitBtn').on('click', function() {
				
				var data = {};
				data["_token"] = $("input[name=_token]").val();
				data["title"] = $("#titlePortfolio").val();
				data["slug"] = $("#slugPortfolio").val();
				data["client"] = $("#clientPortfolio").val();
				data["description"] = $("#descriptionPortfolio").val();
				data["category"] = $('.radio input[name=category]:checked').val();
				data["link"] = $("#linkPortfolio").val();
				data["featuredImage"] = $(this).data('id');

				$('#gallerycontainer input').each(function() {
					data[$(this).attr("name")] = $(this).val();
				});

				//function for storing portfolios to database
				$.ajax({
					type: 'POST',
					url: url,
					data: data,
					success : function(data) {
						$('.portfolio_container').html(data);
						//calling button function portfolio
						editButton();
						addPortfolio();
						chooseGalleryImages();
						deleteBtn();
						paginationLink();
					},
					error : function(data) {
						var errors = data.responseJSON.errors;
						console.log(errors);
						if(errors != null) {
							$('.message').addClass('alert alert-danger');
							$('.message').show();
							for (data in errors) {
								$('.message h4').html(errors[data]);
							}
						}
					}
				});
			});
		}


//general function 

		//function to clear message
		function clearMessage() {
			$('.message').hide();
			if($('.message').hasClass('alert-info')) {
				$('.message').removeClass('alert-info');	
			} 

			if($('.message').hasClass('alert-success')) {
				$('.message').removeClass('alert-success');
			}

			if($('.message').hasClass('alert-danger')) {
				$('.message').removeClass('alert-danger');
			}
			
			$('.message h4').text('');
		}

		// function ajax for portfolio list
		function paginationLink() {
			$('body').on('click', '.pagination a', function(e) {
				e.preventDefault();
				var url = $(this).attr('href');
				$.ajax({
					url: url,
					success: function(data) {
						$('.portfolio_container').html(data);
						//calling button function portfolio
						editButton();
						addPortfolio();
						deleteBtn();
					},
				});
				window.history.pushState("", "", url);
				clearMessage();
			});
		}

//edit portfolio
		//calling edit portfolio
		function editButton() {
			$('.editBtn').on('click', function() {
				clearMessage();
				var urlEdit = $(this).data('urledit');
				var urlUpdate = $(this).data('urlupdate');
				$.ajax({
					url: urlEdit,
					success: function(data) {
						$('.portfolio_container').html(data);
						editFeaturedImage();
						makeSummernote();
						autoSlug();
						ajaxUpdatePortfolio(urlUpdate);
						chooseGalleryImages();
						removeGalleryImages();


						//add dropdown functionality
						$('#addFeaturedImage').on('click', function() {
							var urlfi = $(this).data('urlfi');
							var urlgi = $(this).data('urlgi');
							Dropzone.autoDiscovery = false;
							//configure the logo dropzone
							$("form#featuredImageDz").dropzone({
								acceptedFiles: "image/*",
								addRemoveLinks: true,
								uploadMultiple: true,
								successmultiple: function(file, response) {
									//update featured image list
									$.ajax({
										type:"POST",
										url:urlfi,
										data:{
											'_token': $('input[name=_token]').val(),
										},
										success: function(data) {
											$('#featuredImageTab').html(data);
											$('#featuredImageTab').addClass('active in');
											$('#uploadFeaturedImageTab').removeClass('active in');
											$('#featuredImageList').addClass('active');
											$('#uploadFeaturedImageList').removeClass('active');
											chooseFeaturedImage();
										},
									});


									//update gallery image list
									$.ajax({
										type:"POST",
										url:urlgi,
										data:{
											'_token': $('input[name=_token]').val(),
										},
										success: function(data) {
											$('#listGalleryImageTab').html(data);
											$('#listGalleryImageTab').addClass('active in');
											$('#uploadGalleryImageTab').removeClass('active in');
											$('#listGalleryImage').addClass('active');
											$('#uploadGalleryImage').removeClass('active');
											chooseGalleryImages();
										},
									});
								},
							});
						});


						//add gallery images pressed
						$('#addGalleryImages').on('click', function() {
							Dropzone.autoDiscovery = false;
							var urlfi = $(this).data('urlfi');
							var urlgi = $(this).data('urlgi');
							

							//configure the logo dropzone
							$("form#galleryImagesDz").dropzone({
								acceptedFiles: "image/*",
								addRemoveLinks: true,
								uploadMultiple: true,
								successmultiple: function(file, response) {
									//update featured image list
									$.ajax({
										type:"POST",
										url:urlfi,
										data:{
											'_token': $('input[name=_token]').val(),
										},
										success: function(data) {
											$('#featuredImageTab').html(data);
											$('#featuredImageTab').addClass('active in');
											$('#uploadFeaturedImageTab').removeClass('active in');
											$('#featuredImageList').addClass('active');
											$('#uploadFeaturedImageList').removeClass('active');
											chooseFeaturedImage();
										},
									});


									//update gallery image list
									$.ajax({
										type:"POST",
										url:urlgi,
										data:{
											'_token': $('input[name=_token]').val(),
										},
										success: function(data) {
											$('#listGalleryImageTab').html(data);
											$('#listGalleryImageTab').addClass('active in');
											$('#uploadGalleryImageTab').removeClass('active in');
											$('#listGalleryImage').addClass('active');
											$('#uploadGalleryImage').removeClass('active');
											chooseGalleryImages();
										},
									});

								},
							});
						});


					},
				});

				clearMessage();
			});
		}

		//function for portfolio edit portfolio featuredimage
		function editFeaturedImage() {
			$('#addFeaturedImage').hide();
			$('.portfolio-featured-image').on('click', function() {
				var name = $(this).data('name');
				var id = $(this).data('id');
				$('#addFeaturedImage').hide();
				$('.removeFeaturedImage a').attr('data-id',id)
				$('.removeFeaturedImage img').attr('src',name);
				$('.removeFeaturedImage').show();
				$('.editBtn').attr('data-id', id);
			});

			$('.removeFeaturedImage a').on('click', function() {
				$('.editBtn').attr('data-id', '');
				$(this).parent().slideUp('slow', function() {
					setTimeout(function() {
						$('#addFeaturedImage').slideDown('slow');
					}, 500);
				});
			});
		}

//update portfolio
		
		//function approve edit portfolio
		function ajaxUpdatePortfolio(urlUpdate) {
			$('.editBtn').on('click', function() {
				var data = {};
				data["_token"] = $("input[name=_token]").val();
				data["title"] = $("#titlePortfolio").val();
				data["slug"] = $("#slugPortfolio").val();
				data["client"] = $("#clientPortfolio").val();
				data["description"] = $("#descriptionPortfolio").val();
				data["category"] = $('.radio input[name=category]:checked').val();
				data["link"] = $("#linkPortfolio").val();
				data["featuredImage"] = $(this).data('id');

				$('#gallerycontainer input').each(function() {
					data[$(this).attr("name")] = $(this).val();
				});

				$.ajax({
					type: "put",
					url: urlUpdate,
					data: data,
					success: function(data) {
						$('.portfolio_container').html(data);
						//calling button function portfolio
						editButton();
						addPortfolio();
						deleteBtn();
						paginationLink();
					},

					error: function(data) {
						var errors = data.responseJSON.errors;
						//console.log(data);
						if(errors != null) {
							$('.message').addClass('alert alert-danger');
							$('.message').show();
							for (data in errors) {
								$('.message h4').html(errors[data]);
							}
						}
					},
				});
			});
		}
	});
</script>

<script>
	Dropzone.autoDiscover = false;
</script>