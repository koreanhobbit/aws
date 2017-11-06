<script>
    $(document).ready(function() {

        //function show modal hash on url
        hash();

        //function show modal hash on url
        function hash() {
            $(window.location.hash).modal('show');
            $('a[data-toggle="modal"]').click(function() {
                revertToBeforePaginationUrl();
                window.location.hash = $(this).attr('href');
            });

            $('.modal').on('hidden.bs.modal', function () {
                revertToBeforeModalUrl();
            });
        }
        
        //function revert to original Url before modal
        function revertToBeforeModalUrl() {
            var original = window.location.href.substr(0, window.location.href.indexOf('#'))
            history.replaceState({}, document.title, original);
        }

        //function revert to original Url before modal
        function revertToBeforePaginationUrl() {
            var original = window.location.href.substr(0, window.location.href.indexOf('?'))
            history.replaceState({}, document.title, original);
        }

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
            $('.blog-modal-link, .portfolio-link').on('click', function() {
                modalLink = $(this).data('target');
                imageLink = $(this).data('link');

                // alert(modalLink + imageLink);
                $(modalLink + " " + ".main-img").attr('src', imageLink);
                $(modalLink + " " + ".img-gallery img").removeClass('selected_img');
                $(modalLink + " " + ".main-img-gallery img").addClass('selected_img');
            });
        }
    });
</script>