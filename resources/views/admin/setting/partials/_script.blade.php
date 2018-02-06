@section('script')
	<script>
		$(document).ready(function() {
			clearMessage();
			updateSetting();
			logoLink();
			iconLink();

			
			// logo link function
			function logoLink() {
				$('.logoLink').on('click', function() {
					clearMessage();
					var imgLink = $(this).data('link');
					var imgId = $(this).data('imageid');
					$('.logoImgBtn img').attr('src', imgLink);
					$('#logoModal').modal('hide');
					$('#logoinput').val(imgId);
				});
			} 

			// logo link function
			function iconLink() {
				$('.iconLink').on('click', function() {
					clearMessage();
					var imgLink = $(this).data('link');
					var imgId = $(this).data('imageid');
					$('.iconImgBtn img').attr('src', imgLink);
					$('#iconModal').modal('hide');
					$('#iconinput').val(imgId);
				});
			}

			function updateSetting() {
				//update setting
				$('.saveBtn').on("click", function() {
					var url = $(this).data('url');
					var urlIndex = $(this).data('urlindex');
					var data ={};
						data["_token"] = $("input[name=_token]").val();
						data["site_title"] = $("input[name=site_title]").val();
						data["tagline"] = $("input[name=tagline]").val();
						data["site_logo"] = $("input[id=logoinput]").val();
						data["site_icon"] = $("input[id=iconinput]").val();
						
						$('.websitesocialmedias_container').each(function(index) {
							data[$(this).find('input').data('name')] = $(this).find('input').val();
						});
					$.ajax({
						type:"PUT",
						url: url,
						data: data,
						success: function(data) {
							$('.setting_container').html(data);
							updateSetting();
						},
						error: function(data) {
							var errors = data.responseJSON.errors;
							if(errors != null) {
								$('.message').addClass('alert alert-danger');
								$('.message').removeClass('hidden');
								for (data in errors) {
									$('.message h4').html(errors[data]);
								}
							}
						}
					});
				});
			}


			function clearMessage() {
				if($('.message').hasClass('alert-success')) {
					$('.message').hide();
					$('.message h4').text('');
					$('.message').removeClass('alert alert-success');
				}

				if($('.message').hasClass('alert-danger')) {
					$('.message').hide();
					$('.message h4').text('');
					$('.message').removeClass('alert alert-danger');
				}
			}


			//reload image after dropzone
			function reloadImage(navListId, navUploadId, tabListId, tabUploadId, url) {
				$.ajax({
					type:"POST",
					url: url,
					data: {
						"_token": $("input[name=_token]").val(),
					},
					success: function(data) {
						$(tabListId).html(data);
						$(tabListId).addClass('active in');
						$(navListId).addClass('active');
						$(tabUploadId).removeClass('active in');
						$(navUploadId).removeClass('active');
						logoLink();
						iconLink();
					}
				});
			}

			$('.logoImgBtn').on('click', function() {
				var urllogo = $(this).data('urllogo');
				var urlicon = $(this).data('urlicon');
				//configure the logo dropzone
				$("form#uploadLogoImage").dropzone({
					acceptedFiles: "image/*",
					addRemoveLinks: true,
					uploadMultiple: true,
					successmultiple: function(file, response) {
						reloadImage("#logoImageLink", "#uploadLogoImageLink", "#logoImage", "#uploadLogoImage", urllogo);
						reloadImage("#iconLink", "#uploadIconLink", "#icon", "#uploadIcon", urlicon);
					}
				});
			});

			$('.iconImgBtn').on('click', function() {
				var urllogo = $(this).data('urllogo');
				var urlicon = $(this).data('urlicon');
				//configure the icon dropzone
				$("form#uploadIcon").dropzone({
					acceptedFiles: "image/*",
					addRemoveLinks: true,
					uploadMultiple: true,
					successmultiple: function(file, response) {
						reloadImage("#logoImageLink", "#uploadLogoImageLink", "#logoImage", "#uploadLogoImage", urllogo);
						reloadImage("#iconLink", "#uploadIconLink", "#icon", "#uploadIcon", urlicon);
					}
				});
			});

			
		});
	</script>

	<script>
		Dropzone.autoDiscover = false;	
	</script>
@endsection