<script>
	$(document).ready(function() {
		//call delete button function 
		deleteBtn();

		//call edit button function 
		editBtn();

		//create team profile
		//call addProfile button
		addProfile();

		//button adding team profile
		function addProfile() {
			$('#addTeamMember').click(function(event) {
				deleteMessage();
				var urlcreate = $(this).data('urlcreate');
				var urlstore = $(this).data('urlstore');
				$.ajax({
					url:urlcreate,
					success: function(data) {
						$('.teamprofile_container').html(data);

						//call profile image link
						changeProfile();

						//call storeProfile function 
						storeProfile(urlstore);

						$('#teamprofileImage').on('click', function() {
							var urlreload = $(this).data('urlreload');
							$("form#uploadImageForm").dropzone({
								acceptedFiles: 'image/*',
								addRemoveLinks: true,
								uploadMultiple: true,
	            				successmultiple: function(file,response) {
	                				$.ajax({
	                					type:"POST",
	                					url: urlreload,
	                					data:{
											'_token': $('input[name=_token]').val(),
										},
	                					success: function(data) {
	                						$('#profileImage').html(data);
	                						$('#profileImage').addClass('active in');
	                						$('#profileImageLink').addClass('active');
	                						$('#uploadImage').removeClass('active in');
	                						$('#uploadImageLink').removeClass('active');
	                						//call profile image links
	                						changeProfile();
	                					},
	                				});			
	            				}
							});
						});
					},
				}); 
			});
		}
		

		// function for click the images list for profile image
		function changeProfile() {
			$('.profileImgLink').on('click', function() {
				var link = $(this).data('link');
				var id = $(this).data('imageid');
				$('#teamprofileModal').modal('hide');
				$('#teamprofileImage img').attr('src', link);
				$('#teamprofileImage img').attr('data-imageid', id);
			});
		}

		//function click add profile (store)
		function storeProfile(urlstore) {
			$('.addProfileBtn').on('click', function() {
				deleteMessage();
				//data to store
				var data = {};
				data['_token'] = $('input[name=_token]').val();
				data['imageid'] = $('#teamprofileImage img').data('imageid');
				data['name'] = $('input[id=teamprofileName]').val();
				data['month'] = $('select[id=month]').val();
				data['date'] = $('input[id=date]').val();
				data['year'] = $('input[id=year]').val();
				data['email'] = $('input[id=teamprofileEmail]').val();
				data['job_title'] = $('input[id=teamprofileJobTitle]').val();
				data['user_role'] = $('select[id=teamprofileUserRole]').val();
				data['user_status'] = $('select[id=teamprofileUserStatus]').val();
				data['location'] = $('input[id=teamprofileLocation]').val();
				data['description'] = $('textarea[id=teamprofileDescription]').val();
				$('.teamprofileSocialMedias').each(function(index) {
						data[$(this).find('input').data('name')] = $(this).find('input').val();
				});

				$('.teamprofileAttributes').each(function(index) {
					data[$(this).find('input').data('name')] = $(this).find('input').val();
				});

				//ajaxs call
				$.ajax({
					type: "POST",
					url: urlstore,
					data: data,
					success: function(data) {
						$('.teamprofile_container').html(data);
						
						//call delete button
						deleteBtn();
						addProfile();
						editBtn();
						$('.message').removeClass('hidden');
						$('.message').addClass('alert alert-success');
						$('.message h4').text('Member successfully added.');

					},
					error: function(data) {
						var errors = data.responseJSON.errors;
						if(errors != null) {
							$('.message').addClass('alert alert-danger');
							$('.message').removeClass('hidden');
							for(data in errors) {
								$('.message h4').text(errors[data]);
							}
						}
					},
				});
			});
		}

		//function for edit button
		function editBtn() {
			$('.editBtn').click(function() {
				deleteMessage();
				var url = $(this).data('url');
				var urlupdate = $(this).data('urlupdate');
				$.ajax({
					type: 'get',
					url: url,
					success: function(data) {
						$('.teamprofile_container').html(data);
						changeProfile();
						updateBtn(urlupdate);
						changePasswordButton();
						cancelChangePasswordButton();
						$('#teamprofileImage').on('click', function() {
							var urlreload = $(this).data('urlreload');
							$("form#uploadImageForm").dropzone({
								acceptedFiles: 'image/*',
								addRemoveLinks: true,
								uploadMultiple: true,
	            				successmultiple: function(file,response) {
	                				$.ajax({
	                					type:"POST",
	                					url: urlreload,
	                					data:{
											'_token': $('input[name=_token]').val(),
										},
	                					success: function(data) {
	                						$('#profileImage').html(data);
	                						$('#profileImage').addClass('active in');
	                						$('#profileImageLink').addClass('active');
	                						$('#uploadImage').removeClass('active in');
	                						$('#uploadImageLink').removeClass('active');
	                						//call profile image links
	                						changeProfile();
	                					},
	                				});			
	            				}
							});
						});
					},
				});
			}); 
		}

		function updateBtn(urlupdate) {
			$('.editProfileBtn').click(function() {
				deleteMessage();
				//data to store
				var data = {};
				data['_token'] = $('input[name=_token]').val();
				data['imageid'] = $('#teamprofileImage img').data('imageid');
				data['name'] = $('input[id=teamprofileName]').val();
				data['month'] = $('select[id=month]').val();
				data['date'] = $('input[id=date]').val();
				data['year'] = $('input[id=year]').val();
				data['email'] = $('input[id=teamprofileEmail]').val();
				data['job_title'] = $('input[id=teamprofileJobTitle]').val();
				data['user_role'] = $('select[id=teamprofileUserRole]').val();
				data['user_status'] = $('select[id=teamprofileUserStatus]').val();
				data['current_password'] = $('input[id=teamprofileCurrentPassword]').val();
				data['password'] = $('input[id=teamprofileNewPassword]').val();

				data['password_confirmation'] = $('input[id=teamprofileConfirmPassword]').val();
				data['location'] = $('input[id=teamprofileLocation]').val();
				data['description'] = $('textarea[id=teamprofileDescription]').val();
				$('.teamprofileSocialMedias').each(function(index) {
						data[$(this).find('input').data('name')] = $(this).find('input').val();
				});

				$('.teamprofileAttributes').each(function(index) {
					data[$(this).find('input').data('name')] = $(this).find('input').val();
				});

				//ajaxs call
				$.ajax({
					type: "PUT",
					url: urlupdate,
					data: data,
					success: function(data) {
						$('.teamprofile_container').html(data);
						
						//call delete button
						deleteBtn();
						addProfile();
						editBtn();
						$('.message').removeClass('hidden');
						$('.message').addClass('alert alert-success');
						$('.message h4').text('Member successfully edited.');
					},
					error: function(data) {
						var errors = data.responseJSON.errors;
						if(errors != null) {
							$('.message').addClass('alert alert-danger');
							$('.message').removeClass('hidden');

							for(data in errors) {
								$('.message h4').text(errors[data]);
							}
						}
					},
				});
			});
		}

		//function for delete button
		function deleteBtn() {
			$('.deleteBtn').click(function() {
				deleteMessage();
				var conf = confirm('Are you sure want to delete this profile?');
				if(conf == true) {
					var url = $(this).data('url');
					deleteTeamProfile(url);
				}
			});
		}

		//function ajax for deleting team member
		function deleteTeamProfile(url) {
			$.ajax({
				type:"delete",
				url: url,
				data: {
					'_token' : $('input[name=_token]').val(),
				},

				success: function(data) {
					$('.teamprofile_container').html(data);
					
					//call delete button function 
					deleteBtn();

					//call edit button function 
					editBtn();

					//create team profile
					//call addProfile button
					addProfile();
					$('.message').removeClass('hidden');
					$('.message').addClass('alert alert-success');
					$('.message h4').text('Member successfully deleted.');
				},
				error: function(data) {

				},
			});
		}

		//delete message function 
		function deleteMessage() {
			$('.message').addClass('hidden');
			$('.message h4').text('');
			if($('.message').hasClass('alert-success')) {
				$('.message').removeClass('alert alert-success');
			}
			if($('.message').hasClass('alert-danger')) {
				$('.message').removeClass('alert alert-danger');
			}
			if($('.message').hasClass('alert-info')) {
				$('.message').removeClass('alert alert-info');
			} 
		}

		//change password button
		function changePasswordButton() {
			$('#changePassBtn').click(function() {
				$('.changePasswordContainer').removeClass('hidden');
				$('#cancelchangePassBtn').removeClass('hidden');
				$(this).addClass('hidden');
			});
		}

		//cancel change password button
		function cancelChangePasswordButton() {
			$('#cancelchangePassBtn').click(function() {
				$('.changePasswordContainer').addClass('hidden');
				$('#changePassBtn').removeClass('hidden');
				$(this).addClass('hidden');

				//empty the value of input
				$('#teamprofileCurrentPassword').val('');
				$('#teamprofileNewPassword').val('');
				$('#teamprofileConfirmPassword').val('');
			});
		}
	});
</script>