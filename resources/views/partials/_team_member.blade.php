@if(!count($members))
<!-- Team Section -->
    <section id="team">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Our Amazing Team</h2>
                    <h3 class="section-subheading text-muted">Meet our lovely team members.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="team-member">
                        <img src="img/team/1.jpg" class="img-responsive img-circle" alt="">
                        <h4>Kay Garland</h4>
                        <p class="text-muted">Lead Designer</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="team-member">
                        <img src="img/team/2.jpg" class="img-responsive img-circle" alt="">
                        <h4>Larry Parker</h4>
                        <p class="text-muted">Lead Marketer</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="team-member">
                        <img src="img/team/3.jpg" class="img-responsive img-circle" alt="">
                        <h4>Diana Pertersen</h4>
                        <p class="text-muted">Lead Developer</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <p class="large text-muted">Alone we can do so little, together we can do so much.</p>
                </div>
            </div>
        </div>
    </section>
@else
    <!-- Team Section -->
    <section id="team">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Our Amazing Team</h2>
                    <h3 class="section-subheading text-muted">Meet our lovely team members.</h3>
                </div>
            </div>
            <div class="row">
                @foreach($members as $member)
                    <div class="col-sm-4">
                        <div class="team-member">
                            <a href="{{ $member->name }}" data-toggle="modal" data-target="#member{{ $member->id }}"><img src="{{ url($member->images->first()->path . $member->images->first()->name) }}" class="img-responsive img-circle" alt="" style="height: 239px; width:239px;"></a>
                            <h4>{{ ucfirst($member->name) }}</h4>
                            <p class="text-muted">{{ $member->job_title }}</p>
                            <ul class="list-inline social-buttons">
                                <li>
                                    <a href="mailto:{{ $member->email }}?Subject=TopWebStudio%20Client%20Contact" target="_top" title="Email">
                                        <i class="fa fa-envelope"></i>
                                    </a>
                                </li>
                                @foreach($member->profilesocialmedias as $item)
                                    <li><a href="{{ $item->pivot->link }}" target="_blank" title="{{ ucfirst($item->name) }}"><i class="fa fa-{{ $item->icon }}"></i></a>
                                    </li> 
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
             <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <p class="large text-muted">Alone we can do so little, together we can do so much.</p>
                </div>
            </div>
        </div>
    </section>
@endif