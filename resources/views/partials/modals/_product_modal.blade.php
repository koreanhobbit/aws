@foreach($products as $product)
    <div class="home-modal modal fade" id="{{ $product->slug }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2 class="text-center" style="overflow-wrap: break-word;">{{ $product->name }}</h2>
                                <br>
                                <br>
                                <br>
                                @foreach($product->images as $image)
                                    @if($image->pivot->is_maskot == 1)
                                        <img class="img-responsive img-centered main-img" src="{{ asset($image->imageMid->location) }}" title="{{ $image->name }}">
                                    @endif
                                @endforeach
                                <div class="row">    
                                    @foreach($product->images as $image)
                                        @if($image->pivot->is_maskot == 1)
                                            <div class="col-md-2 col-sm-4 col-xs-4">
                                                <a href="javascript:" class="img-gallery main-img-gallery" data-url="{{ asset($image->imageMid->location) }}"> <img src="{{ asset($image->thumbnail->location) }}" title="{{ $image->name }}" class="img-responsive img-thumbnail selected_img" style="height: 110px;min-height: 110px;"></a>
                                            </div>
                                        @elseif($image->pivot->is_maskot == 0)    
                                            <div class="col-md-2 col-sm-4 col-xs-4">
                                                <a href="javascript:" class="img-gallery" data-url="{{ asset($image->imageMid->location) }}"> <img src="{{ asset($image->thumbnail->location) }}" alt="" class="img-responsive img-thumbnail" style="height: 110px;min-height: 110px;"></a>
                                            </div>
                                        @endif    
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p>
                                            {!! $product->description !!}
                                        </p>
                                    </div>
                                </div>
                                <form name="sentMessage" id="productForm" novalidate data-urlstore="{{ route('home.contact') }}">
                                     {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                Please complete this form so we can process your package immediately
                                            </div>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label for="name_product" class="pull-left">Name</label>
                                                    <input type="text" name="name_product" id="name_product" class="form-control" required data-validation-required-message="Please enter your full name">
                                                    <p class="help-block text-danger    text-left" style="color: red;">
                                                    </p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email_product" class="pull-left">Email Address</label>
                                                    <input type="email" name="email_product" id="email_product" class="form-control" required data-validation-required-message="Please enter your valid E-mail address">
                                                     <p class="help-block text-danger text-left" style="color: red;">
                                                    </p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone_product" class="pull-left">Phone Number</label>
                                                    <input type="tel" name="phone_product" id="phone_product" class="form-control" required data-validation-required-message="Please enter your valid phone number">
                                                     <p class="help-block text-danger text-left" style="color: red;">
                                                    </p>
                                                </div>
                                                <input type="hidden" name="message_product" id="message_product" value="Hi I'm interested with &nbsp; {{ $product->name }}">
                                            </div>
                                            <div class="panel-footer">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                            Submit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div id="successProduct"></div>                                 
                                </div>
                                </form>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-sm-12">    
                                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Check Other Packages</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach