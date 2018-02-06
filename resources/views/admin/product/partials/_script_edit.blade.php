<script>
	$(document).ready(function() {
		//calling the summer note
		$('#description_product').summernote({
			minHeight : 300
		});
		// click add featured image
		$('.add_fi').click(function(event) {
			var urlfi = $(this).data('urlfi');
			var urlgi = $(this).data('urlgi');
			$('#featuredImageDz').dropzone({
				acceptedFiles: 'image/*',
				addRemoveLinks: true,
				uploadMultiple: true,
				successmultiple: function() 
				{
					$.ajax({
						type: "POST",
						url: urlfi,
						data:{
							'_token' : $('input[name=_token]').val(),
						},
						success: function(data)
						{
							$('#featuredImageTab').html(data);
							$('#featuredImageTab').addClass('active in');
							$('#featuredImageList').addClass('active');
							$('#uploadFeaturedImageList').removeClass('active');
							$('#uploadFeaturedImageTab').removeClass('active in');
							featuredImageLink();
						},
					});

					$.ajax({
						type: "POST",
						url: urlgi,
						data:{
							'_token' : $('input[name=_token]').val(),
						},
						success: function(data)
						{
							$('#galleryImageTab').html(data);
							$('#galleryImageTab').addClass('active in');
							$('#uploadGalleryImageTab').removeClass('active in');
							$('#galleryImageList').addClass('active');
							$('#uploadGalleryImageList').removeClass('active');
							galleryImageLink();
						},
					})
				},
			});
		});

		featuredImageLink();

		function featuredImageLink()
		{
			$('.featured-img-link').click(function()
				{
					var urlimage = 
					$('.add_fi').addClass('hidden');
					$('.remove_fi').removeClass('hidden');
					$('.remove_fi img').attr('src', $(this).data('name'));
					$('.featuredimage').val($(this).data('id'));
				});

			$('.remove_fi').click(function()
				{
					$(this).addClass('hidden');
					$('.add_fi').removeClass('hidden');
					$('.featuredimage').val('');
				});
		}


		//click add gallery image
		$('.add_gi').click(function(event) {
			var urlfi = $(this).data('urlfi');
			var urlgi = $(this).data('urlgi');
			$('#galleryImageDz').dropzone({
				acceptedFiles: 'image/*',
				addRemoveLinks: true,
				uploadMultiple: true,
				successmultiple: function() 
				{
					$.ajax({
						type: "POST",
						url: urlfi,
						data:{
							'_token' : $('input[name=_token]').val(),
						},
						success: function(data)
						{
							$('#featuredImageTab').html(data);
							$('#featuredImageTab').addClass('active in');
							$('#featuredImageList').addClass('active');
							$('#uploadFeaturedImageList').removeClass('active');
							$('#uploadFeaturedImageTab').removeClass('active in');
							featuredImageLink();
						},
					});

					$.ajax({
						type: "POST",
						url: urlgi,
						data:{
							'_token' : $('input[name=_token]').val(),
						},
						success: function(data)
						{
							$('#galleryImageTab').html(data);
							$('#galleryImageTab').addClass('active in');
							$('#uploadGalleryImageTab').removeClass('active in');
							$('#galleryImageList').addClass('active');
							$('#uploadGalleryImageList').removeClass('active');
							galleryImageLink();
						},
					})
				},
			});
		});

		galleryImageLink();

		function galleryImageLink()
		{
			//toggle gallery image
			$('.img-gallery-link').click(function()
				{
					$(this).parent().toggleClass('selected');
				});

			//add images gallery button
			$('#add_gallery_btn').click(function()
				{
					if($('.gallerydisplay').length) 
					{
						$.each($('.selected'), function()
							{
								var selected = $(this).children('a').data('id');
								var selfSelected = $(this);
								$.each($('.gallerydisplay'), function()
									{
										if($(this).data('id') == selected)
										{
											selfSelected.addClass('existimage');
										}
									});
								if(!selfSelected.hasClass('existimage'))
								{
									$('#gallerycontainer').append('<div class="thumbnail gallerydisplay col-sm-6" data-id="' + selected + '"> <img src="' + $(this).children().data('name') + '" class="img-responsive gal-img"> <div class="remove-img"><i class="fa fa-remove"></i></div> <input type="hidden" name="galleryimg[' + selected + ']" value="' + selected + '"></div>');
								}
							});
					}
					if(!$('.gallerydisplay').length)
					{
						$.each($('.selected'), function()
							{
								var selected = $(this).children('a').data('id');
								var selfSelected = $(this);

								$('#gallerycontainer').append('<div class="thumbnail gallerydisplay col-sm-6" data-id="' + selected + '"> <img src="' + $(this).children().data('name') + '" class="img-responsive gal-img"> <div class="remove-img"><i class="fa fa-remove"></i></div> <input type="hidden" name="galleryimg[' + selected + ']" value="' + selected + '"></div>');
							});
					}
					removeClassGi();
					removeGalleryImages();
				});

		}

		function removeClassGi() 
		{
			if($('.img-gallery-link').parent().hasClass('selected'))
			{
				$('.img-gallery-link').parent().removeClass('selected');	
			}

			if($('.img-gallery-link').parent().hasClass('existimage'))
			{
				$('.img-gallery-link').parent().removeClass('existimage');
			}
		}

		removeGalleryImages();
		//remove gallery images function 
		function removeGalleryImages() 
		{
			$('.gal-img, .remove-img').click(function(e) {
				e.preventDefault();
				$(this).parent().remove();
			});
		}

		submitButton();
		//function submit button
		function submitButton() {
			$('.btn-publish').click(function() 
				{
					$('.is_published').val(1);
				});

			$('.btn-draft').click(function() 
				{
					$('.is_published').val(0);
				});
		}
	});
</script>
<script>
	Dropzone.autoDiscover = false;
</script>