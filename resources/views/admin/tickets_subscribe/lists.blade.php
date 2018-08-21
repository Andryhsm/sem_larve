
                <div class="tickets-content">
                    <!-- <div class="tickets-title text-center">
                        <h2>{!! trans('tickets.my_tickets') !!}</h2>
                    </div> -->
                    <div class="collapses-group">
                    <div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">

                        @foreach($tickets as $ticket)                            
                           <div class="panel panel-default" id="ticket{!! $ticket->id !!}" onclick="activate(this);">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#collapse{!! $ticket->id !!}{!! $ticket->user_id !!}" aria-expanded="true" aria-controls="collapse{!! $ticket->id !!}{!! $ticket->user_id !!}">
                                           {!! $ticket->subject !!}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse{!! $ticket->id !!}{!! $ticket->user_id !!}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{!! $ticket->id !!}{!! $ticket->user_id !!}">
                                    <div class="panel-body">
                                            <h4 class="title">{!! trans('tickets.description') !!}</h4>
                                            <div class="content-tickets">
                                                <p>{!! $ticket->content !!}</p>
                                            </div>

                                            <h4 class="title">{!! trans('tickets.comments') !!}</h4>
                                            <div class="comment-list">
                                                @if(isset($ticket->comments))
                                                  @foreach($ticket->comments as $comment)
                                                    <div class="panel panel-primary">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">
                                                                
                                                                {!! $comment->admin['first_name'] !!} {!! $comment->admin['last_name'] !!}
                                                                
                                                                <span class="pull-right"> {!! $comment->created_at->diffForHumans() !!} </span>
                                                            </h3>
                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="content-comment">
                                                                {!! $comment->content !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach 
                                                @endif
                                            </div>
                                            <div class="" style="padding-top: 10px;">
                                                <form method="post" action="{!! url('partner/tickets-subscribe/add_comment') !!}" class="form-comment">
                                                    <input class="hidden" id="ticket-id" type="number" name="ticket_id" value="{!! $ticket->id !!}">
                                                    <div class="form-group">
                                                        <textarea class="form-control content-comment" rows="8" id="message" name="content"></textarea>
                                                    </div>
                                                    <div class="">
                                                        <a class="btn btn-primary add-comment pull-right">{!! trans('tickets.reply') !!}
                                                        </a>
                                                    </div>
                                                </form>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

