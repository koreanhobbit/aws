@if (!count($messages))
    @if($dashboard == true)
        <div class="alert alert-info">
            <h3>No Recent Activities</h3>
        </div>
    @else
        <div class="alert alert-info">
            <h3>There is no message</h3>
        </div>
    @endif
@else
    <ul class="timeline">
        @foreach($messages as $key => $message)
            @if($key % 2 == 0)
                <li>
                    <div class="timeline-badge"><a href="javascript:" class="reply" data-url="{{ route('dashboard.reply', ['rp' => $message->id]) }}"><i class="fa fa-envelope"></i></a>
                    </div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4 class="timeline-title">{{ ucfirst($message->name) }}
                                <span>
                                    <p>
                                        <small>
                                            <i class="fa fa-envelope"></i> {{ $message->email }} | <i class="fa fa-phone"></i> {{ $message->phone }}
                                        </small>
                                    </p>
                                </span>
                            </h4>
                            
                            <p>
                                <small class="text-muted"><i class="fa fa-clock-o"></i> {{ $message->created_at->diffForHumans() }}
                                </small>
                            </p>
                        </div>
                        <div class="timeline-body text-justify">
                            <p style="overflow-wrap:break-word;">{{ ucfirst($message->message) }}</p>
                        </div>
                    </div>
                </li>
           @else 
                <li class="timeline-inverted">
                    <div class="timeline-badge warning"><a href="javascript:" class="reply" data-url="{{ route('dashboard.reply', ['rp' => $message->id]) }}"><i class="fa fa-envelope"></i></a>
                    </div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4 class="timeline-title">{{ ucfirst($message->name) }}
                                <span>
                                    <p>
                                        <small>
                                            <i class="fa fa-envelope"></i> {{ $message->email }} | <i class="fa fa-phone"></i> {{ $message->phone }}
                                        </small>
                                    </p>
                                </span>
                            </h4>
                            <p>
                                <small class="text-muted"><i class="fa fa-clock-o"></i> {{ $message->created_at->diffForHumans() }}
                                </small>
                            </p>
                        </div>
                        <div class="timeline-body text-justify">
                            <p style="overflow-wrap:break-word;">{{ ucfirst($message->message) }}</p>
                        </div>
                    </div>
                </li>
            @endif
        @endforeach
    </ul>
    <div class="text-center">
        {{ $messages->links() }}
    </div>
@endif