@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            @if($ticket->type == "Ticket")
            Tickets Details
            @else
            Contacts Details
            @endif
        </h1>
    </section>
    <section class="content">
        @include('admin.layout.notification')

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <h2 class="header">
                            {!! $ticket->content !!}                        
                        </h2>
                        <div class="panel well well-sm">
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <p> <strong>Customer</strong>: {!! $ticket->name !!} </p>
                                        <p>
                                            @if($ticket->type == "Ticket")
                                            <strong>Status</strong>: 
                                            <span style="color: {!! ($ticket->status_id != null) ?$ticket->status->color:"#ffffff"; !!}">
                                                {!! ($ticket->status_id != null) ? $ticket->status->english->name:"" !!}
                                            </span>
                                            @else
                                            <strong>Email</strong>: 
                                            <span>
                                                {!! $ticket->email !!}
                                            </span>
                                            @endif                                            
                                        </p>
                                        <p>
                                            <strong>Priority</strong>: 
                                            <span style="color: {!! ($ticket->priority_id != null) ?$ticket->priority->color:"#ffffff"; !!}">
                                                {!! ($ticket->priority_id != null) ? ($ticket->priority->english->name) : "" !!}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- <p> <strong>Responsible</strong>: Kitty Weimann</p> -->
                                        <p>
                                            <strong>Category</strong>: 
                                            <span style="color: {!! $ticket->category->color !!}">
                                                {!! $ticket->category->english->name !!}
                                            </span>
                                        </p>
                                        <p> <strong>Created</strong>: {!! $ticket->created_at->diffForHumans() !!}</p>
                                        <p> <strong>Last Update</strong>: {!! $ticket->updated_at->diffForHumans() !!} </p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    @if($ticket->type == "Ticket")
                                        @if($ticket->status->english->name == $default_status->english->name)
                                            <div class="col-md-3" style="margin-right: 7px;">
                                                {!! Form::open(['url' => 'admin/tickets/selectstatus', 'class' => 'pull-right','method'=>'POST']) !!}
                                                    {!! Form::select('status_id', $statuses, $ticket->status_id, ['class' => 'form-control required','id'=>'select_status']) !!}    
                                                    {!! Form::text('ticket_id', ($ticket)? $ticket->id:null, ['class' => 'hidden form-control required','id'=>'ticket_id','placeholder'=>"Id"]) !!}

                                                {!! Form::button('Status', ['type' => 'submit', 'class' => 'btn-status btn btn-success hidden','title'=>'Reopen Ticket'] ) !!}
                                                {{ Form::close() }}
                                            </div>
                                        @else 
                                            <div class="col-lg-4 row" style="width: 32.333333% !important;margin-right: 7px;">
                                                {!! Form::open(['url' => 'admin/tickets/reopen', 'class' => 'pull-right','method'=>'POST']) !!}

                                                {!! Form::text('ticket_id', ($ticket)? $ticket->id:null, ['class' => 'hidden form-control required','id'=>'ticket_id','placeholder'=>"Id"]) !!}

                                                {!! Form::button('Reopen Ticket', ['type' => 'submit', 'class' => 'btn btn-success','title'=>'Reopen Ticket'] ) !!}
                                                {{ Form::close() }}
                                            </div>
                                        @endif
                                    @endif
                                    <div class="col-md-6">
                                    <a href="{!! Url("admin/tickets/$ticket->id/edit") !!}" class="btn btn-primary"><i class="fa fa-fw fa-edit"></i> Update</a> 

                                    {!! Form::open(array('url' => 'admin/tickets/' . $ticket->id, 'class' => 'pull-right')) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::button('<i class="fa fa-fw fa-trash"></i> Delete', ['type' => 'submit', 'class' => 'btn delete-btn btn-danger','title'=>'Delete'] ) !!}
                                    {{ Form::close() }}
                                    </div>

                                </div>

                            </div>
                        </div>

                        @if($ticket->type == "Ticket")
                        <h2>Comments</h2>
                        @foreach($ticket->comments as $comment)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    @if($comment->type_compte == 1)
                                        {!! $comment->user->first_name !!} {!! $comment->user->last_name !!}
                                    @else
                                        {!! $comment->admin['first_name'] !!} {!! $comment->admin['last_name'] !!}
                                    @endif
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
                        <div class="form-group">
                            
                        </div>
                        <label class="">Reply</label>

                        {!! Form::open(['url' => route("comments.store"), 'class' => '','id' =>'comment_form','method'=>'POST']) !!}
                            <div class="form-group">
                                <textarea class="textarea required" placeholder="Comments" name="content" id="content">
                                                            <!-- Contenu du champs -->
                                </textarea>
                            </div>
                            <div class="form-group hidden">
                                {!! Form::label('ticket_id', 'Id', ['class' => '']) !!}
                                {!! Form::text('ticket_id', ($ticket)? $ticket->id:null, ['class' => 'form-control required','id'=>'ticket_id','placeholder'=>"Id"]) !!}
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary pull-right" id="add-comment">Send
                                </button>
                            </div>
                        {!! Form::close() !!}
                        @endif

                    </div>
                    <div class="box-footer">
                        <a href="{!!  url('/admin/tickets') !!}" class="btn btn-default">Cancel</a>
                        <!-- <button type="submit" class="btn btn-primary pull-right" id="add-ticket">Save
                        </button> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('footer-scripts')
    <script type="text/javascript" language="JavaScript">
        $(document).ready(function($) {
            $('#add-comment').click(function () {
                $('#comment_form').validate({
                    rules: {
                        content: {
                            required: true
                        }
                    },
                    errorPlacement: function (error, element) {
                        return error.insertAfter(element);
                    }
                });
                if ($('#comment_form').valid()) {
                    $('#comment_form').submit();
                }
            });

            $('#select_status').change(function(){
                $( ".btn-status" ).trigger( "click" );
            });
        });

    </script>
@stop
