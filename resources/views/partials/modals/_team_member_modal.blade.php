@foreach($members as $member)
    <div class="home-modal modal fade" id="member{{ $member->id }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <div class="col-lg-12">
                            <div class="modal-body">
                                <h2 class="text-center" style="overflow-wrap: break-word;">Profile</h2>
                                <br>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="panel panel-primary">
                                          <div class="panel-heading">
                                             <img src="{{ asset($member->images->first()->imageMid->location) }}" alt="{{ $member->images->first()->name }}" class="img-responsive img-rounded img-centered">
                                          </div>
                                          <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-condensed table-striped">
                                                    <tr>
                                                        <td class="">Name</td>
                                                        <td class="col-xs-1">:</td>
                                                        <td class="pull-left">{{ ucfirst($member->name) }}</td>
                                                    </tr>
                                                     <tr>
                                                        <td class="">Title</td>
                                                        <td class="col-xs-1">:</td>
                                                        <td class="pull-left">{{ ucfirst($member->job_title) }}</td>
                                                    </tr>
                                                     <tr>
                                                        <td class="">Age</td>
                                                        <td class="col-xs-1">:</td>
                                                        <td class="pull-left">{{ \Carbon\Carbon::parse($member->teamprofile->birthday)->diff(\Carbon\Carbon::now())->format('%y years old') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="">Location</td>
                                                        <td>:</td>
                                                        <td class="pull-left">{{ ucfirst($member->teamprofile->location) }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                          </div>
                                          <div class="panel-footer">
                                            <ul class="list-inline social-buttons" style="margin-bottom: 0px;">
                                                <li>
                                                    <a href="mailto:{{ $member->email }}?Subject=TopWebStudio%20Client%20Contact" target="_top" title="Email">
                                                        <i class="fa fa-envelope"></i>
                                                    </a>
                                                </li>
                                                @foreach($member->profilesocialmedias as $item)
                                                    <li>
                                                        <a href="{{ $item->pivot->link }}" target="_blank" title="{{ ucfirst($item->name) }}">
                                                            <i class="fa fa-{{ $item->icon }}"></i>
                                                        </a> 
                                                    </li>
                                                @endforeach
                                            </ul>
                                          </div>
                                        </div>    
                                    </div>
                                    <div class="col-md-8">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading text-justify">
                                                        Description
                                                    </div>
                                                    <div class="panel-body text-justify">
                                                        {{ ucfirst($member->teamprofile->description) }}
                                                    </div>
                                                </div>
                                                @if(count($member->profileattributes))
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading text-justify">Attributes</div>
                                                        <div class="panel-body text-justify">
                                                            <div class="row">
                                                                @foreach($member->profileattributes as $item)
                                                                    <div class="col-md-4">
                                                                        <label for="bar{{$item->name}}">
                                                                            {{ $item->name }}
                                                                        </label>
                                                                        <div id="bar{{ $item->name }}" class="progress">
                                                                            <div class="progress-bar progress-bar-warning" style="width: {{ $item->pivot->value }}%">{{ $item->pivot->value }}</div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <br>
                                <br>
                                <br>
                                <div class="row">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Team Member Profile</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach