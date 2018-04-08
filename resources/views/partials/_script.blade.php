<script>
    $(document).ready(function() {
        //function for blog pagination
        function getBlogpost(url) {
            $.ajax({
                url: url,
                data: {
                    "title" : "blog",
                },
                beforeSend: function () {
                    $('.card_blog').fadeOut('slow');
                },
                success: function(data) {
                    $('#blogscontainer').html(data);
                    $('.card_blog').fadeIn('slow');
                    galleryImgBtn();
                    mainImageLink();
                    hash();
                },
            });
        }
        
        //call gallery image button
        galleryImgBtn();
        mainImageLink();

        //function for gallery image
        function galleryImgBtn() { 
            $('.img-gallery').on('click', function() {
                urlimg = $(this).data('url');
                firstlink = $(this).data('main');
                
                $('.img-gallery img').removeClass('selected_img');
                $(this).find('img').addClass('selected_img');
                $('.main-img').attr('src', urlimg);
            });
        }

        //function for main image link
        function mainImageLink() {
            $('.blog-modal-link, .portfolio-link, .product-modal-link').on('click', function() {
                modalLink = $(this).data('target');
                imageLink = $(this).data('link');

                //alert(modalLink + imageLink);
                $(modalLink + " " + ".main-img").attr('src', imageLink);
                $(modalLink + " " + ".img-gallery img").removeClass('selected_img');
                $(modalLink + " " + ".main-img-gallery img").addClass('selected_img');
            });
        }

        //function for product form
        $("#productForm input").jqBootstrapValidation({
            preventSubmit: true,
            submitError: function($form, event, errors) {
                // additional error messages or events
            },
            submitSuccess: function($form, event) {
                event.preventDefault(); // prevent default submit behaviour
                // get values from FORM
                var urlstore = $('form[id=productForm]').data('urlstore');
                var name = $("input#name_product").val();
                var email = $("input#email_product").val();
                var phone = $("input#phone_product").val();
                var message = $("input#message_product").val();
                var firstName = name; // For Success/Failure Message
                // Check for white space in name for Success/Fail message
                if (firstName.indexOf(' ') >= 0) {
                    firstName = name.split(' ').slice(0, -1).join(' ');
                }
                $.ajax({
                    url: urlstore,
                    type: "POST",
                    data: {
                        _token: $("input[name=_token]").val(),
                        name: name,
                        phone: phone,
                        email: email,
                        message: message
                    },
                    cache: false,
                    success: function() {
                        //Success message
                        $('#successProduct').html("<div class='alert alert-success'>");
                        $('#successProduct > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                            .append("</button>");
                        $('#successProduct > .alert-success')
                            .append("<strong>Your order has been submitted. </strong>");
                        $('#successProduct > .alert-success')
                            .append('</div>');
                        //clear all fields
                        $('#productForm').trigger("reset");
                    },
                    error: function() {
                        // Fail message
                        $('#successProduct').html("<div class='alert alert-danger'>");
                        $('#successProduct > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                            .append("</button>");
                        $('#successProduct > .alert-danger').append($("<strong>").text("Sorry " + firstName + ", it seems that my mail server is not responding. Please try again later!"));
                        $('#successProduct > .alert-danger').append('</div>');
                        //clear all fields
                        $('#productForm').trigger("reset");
                    },
                });
            },
            filter: function() {
                return $(this).is(":visible");
            },
        }); 


        //function show modal hash on url
        // hash();

        //function show modal hash on url
        // function hash() {
        //     $(window.location.hash).modal('show');
        //     $('a[data-toggle="modal"]').click(function() {
        //         revertToBeforePaginationUrl();
        //         window.location.hash = $(this).attr('href');
        //     });

        //     $('.modal').on('hidden.bs.modal', function () {
        //         revertToBeforeModalUrl();
        //     });
        // }
        
        //function revert to original Url before modal
        // function revertToBeforeModalUrl() {
        //     var original = window.location.href.substr(0, window.location.href.indexOf('#'))
        //     history.replaceState({}, document.title, original);
        // }

        //function revert to original Url before modal
        // function revertToBeforePaginationUrl() {
        //     var original = window.location.href.substr(0, window.location.href.indexOf('?'))
        //     history.replaceState({}, document.title, original);
        // }

        $(function() {
            $('body').on('click', '.pagination a', function(e) {
                e.preventDefault();

                var url =$(this).attr('href');

                if(url.search("blog") > -1) {
                    getBlogpost(url);    
                }
                
                galleryImgBtn();
                mainImageLink();

                window.history.pushState("", "", url);
            });
        });   
    });
</script>