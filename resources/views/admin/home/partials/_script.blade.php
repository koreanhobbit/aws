@section('script')
	<script>
		$(document).ready(function(){

			//call the reply message function
			replyMessage();

			//call ajax pagination 
			paginationLink();

			//call all messages function
			allMessages();


			//message details and reply button
			function replyMessage() {
				$('.reply').on('click', function() {
					clearMessage();
					$('.panel-title').text('Reply Message');
					var url = $(this).data('url');
					$.ajax({
						url: url,
						data: {
							'_token' : $('input[name=_token]').val(),
						}, 
						success: function(data) {
							$('.timeline_container').html(data);
							
							//summernote for reply message
							$('#reply_text').summernote({
								minHeight:300
							});

							dashboard();
							allMessages();
							
							//call store response
							storeResponse();
						}
					});
				});
			}

			//go back to dashboard function 
			function dashboard() {
				$('.dashboardBtn').on('click', function() {
					$('.panel-title').text('Responsive Timeline');
					var url = $(this).data('url');
					$.ajax({
						url: url,
						data: {
							'_token' : $('input[name=_token]').val(),
						},
						success: function(data) {
							$('.timeline_container').html(data);
							replyMessage();
							paginationLink();
							allMessages();
						}
					});
				});
			}

			//function for ajax pagination 
			function ajaxPagination(url) {
				$.ajax({
					url: url,
					success: function(data) {
						$(".timeline_container").html(data);
						replyMessage();
					}
				}); 
			}

			//function for pagination link
			function paginationLink() {
				$('body').on('click', '.pagination a', function(e) {
					clearMessage();
					e.preventDefault();
					clearMessage();
					var url = $(this).attr('href');
					ajaxPagination(url);
					window.history.pushState("","", url);
				});
			}

			//message all message function 
			function allMessages() {
				$('.message_details').on('click', function() {
					clearMessage();
					var url = $(this).data('url');
					$.ajax({
						url:url,
						success:function(data) {
							$(".timeline_container").html(data);
							$('.panel-title').text('All Messages');
							replyMessage();
							dashboard();
							paginationLink();
						}
					});
				});
			}

			//message to store response
			function storeResponse() {
				$('.responseBtn').on('click', function() {
					var url = $(this).data('url');
					$.ajax({
						type:"PUT",
						url: url,
						data: {
							"_token" : $('input[name=_token]').val(),
							"response" : $('#reply_text').val().replace(/<\/p>/gi, "\n")
                											.replace(/<br\/?>/gi, "\n")
               	 											.replace(/<\/?[^>]+(>|$)/g, ""),
						},
						success: function(data) {
							$('.timeline_container').html(data);
							allMessages();
							dashboard();
						}

					});
				});
			}

			function clearMessage() {
				$('.message').remove();
			}
		});
	</script>
@endsection 