<!-- Team Section -->
<section id="team" class="bg-light-gray">
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
                        <a href="{{ $member->name }}" data-toggle="modal" data-target="#member{{ $member->id }}"><img src="{{ asset($member->images->first()->imageMid->location) }}" class="img-responsive img-circle" alt="" style="height: 239px; width:239px;"></a>
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