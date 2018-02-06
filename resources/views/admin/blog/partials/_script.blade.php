<script>
	$(document).ready(function() {

		//calling the summer note
            $('#blogpost').summernote({            
                minHeight: 300                                          
            });
        
			{{-- auto populate slug from title value input --}}
			$('#blogtitle').on('keypress blur', function () {
				var val = $(this).val();
				val = val.replace(/\s+/g, '-').toLowerCase();
				$('#blogslug').val(val);
			});
		
		{{-- remove featured image --}}
			$('#remove-fm a').click(function(event) {
				$('#remove-fm').slideUp("slow", function(){
					setTimeout(function() {
						$('#set-featured-img').slideDown('slow');
					}, 500);
				});
				$('#featured-image').val('');
			});

			fimageLink();

			function fimageLink() {
			{{-- click .featured-image-link --}}
				$('.featured-img-link').click(function() {
					var name = $(this).data('name');
				
					$('#remove-fm img').attr('src',name);
					$('#set-featured-img').hide();
					$('#remove-fm').show();
					$('#featured-image').val($(this).data('id'));
				});

			}

			gimageLink();
			function gimageLink() {
				// click image gallery link
					$('.img-gallery-link').click(function(event) {
						$(this).parent().toggleClass('selected');
					});

			// add gallery click button
				$('#addgallery-btn').click(function() {
					
					if($(".gallerydisplay").length) {
						$.each($('.selected'), function (index, value) {
							var selected = $(this).children().data('id');
							var selfSelected = $(this);
							$.each($('.gallerydisplay'), function() {
								if(selected == $(this).data('id')) {
									selfSelected.addClass('doubleData');
								}
							});
							if(!selfSelected.hasClass('doubleData')) {
								$('#gallerycontainer').append("<div class='thumbnail col-sm-6 gallerydisplay' data-id='" + $(this).children().data('id') + "'> <img src='" + $(this).children().data('name') + "' class='img-responsive gal-img'> <div class='remove-img'><i class='fa fa-remove'></i></div> <input type='hidden' name='galleryimg[" + $(this).children().data('id') + "]' value='" + $(this).children().data('id') + "'> </div>");
							}
						});
					}

					if(!$(".gallerydisplay").length) {
						$.each($('.selected'), function (index, value) {
							$('#gallerycontainer').append("<div class='thumbnail col-sm-6 gallerydisplay' data-id='" + $(this).children().data('id') + "'> <img src='" + $(this).children().data('name') + "' class='img-responsive gal-img'> <div class='remove-img'><i class='fa fa-remove'></i></div> <input type='hidden' name='galleryimg[" + $(this).children().data('id') + "]' value='" + $(this).children().data('id') + "'> </div>");
						});
					}


					$('#images-gallery').modal('hide');

					//remove the selected class
					removeClass();
					removeGalleryImages();
				});
			}

			//call the removeGalleryImages
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
				if($('.img-gallery-link').parent().hasClass('selected')) {
					$('.img-gallery-link').parent().removeClass('selected');
				}

				if($('.img-gallery-link').parent().hasClass('doubleData')) {
					$('.img-gallery-link').parent().removeClass('doubleData');
				}
			}


		$('#set-featured-img').on('click', function() {
			var urlfi = $(this).data('urlfi');
			var urlgi = $(this).data('urlgi');
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
							fimageLink();
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
							$('#galleryImageTab').html(data);
							$('#galleryImageTab').addClass('active in');
							$('#uploadGalleryImageTab').removeClass('active in');
							$('#galleryImageList').addClass('active');
							$('#uploadGalleryImageList').removeClass('active');
							gimageLink();
						},
					});
				},
			});
		});
		$('.gallery').on('click', function() {
			var urlfi = $(this).data('urlfi');
			var urlgi = $(this).data('urlgi');
			//configure the icon dropzone
			$("form#galleryImageDz").dropzone({
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
							fimageLink();
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
							$('#galleryImageTab').html(data);
							$('#galleryImageTab').addClass('active in');
							$('#uploadGalleryImageTab').removeClass('active in');
							$('#galleryImageList').addClass('active');
							$('#uploadGalleryImageList').removeClass('active');
							gimageLink();
						},
					});
				},
			});
		});
	});
</script>
