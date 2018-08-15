@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            @if($ticket)
                Update ticket
            @else
                Add ticket
            @endif
        </h1>
    </section>
    <section class="content">
        @include('admin.layout.notification')

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    {!! Form::open(['url' => ($ticket) ? Url("admin/tickets/$ticket->id") :  route("tickets.store"), 'class' => '','id' =>'ticket_form','method'=>($ticket)?'PATCH':'POST']) !!}
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('subject', 'Subject', ['class' => '']) !!}
                            {!! Form::text('subject', ($ticket)? $ticket->subject:null, ['class' => 'form-control required','id'=>'subject','placeholder'=>"Subject"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('content', 'Content', ['class' => '']) !!}
                            <textarea class="textarea" id="content" placeholder="Content" name="content">
                                @if($ticket)
                                    {!!  $ticket->content !!}
                                @endif
                            </textarea>
                        </div>  
                        <div class="form-group">
                            {!! Form::label('priority', 'Priority', ['class' => '']) !!}
                            {!! Form::select('priority', $priorities, ($ticket)? $ticket->priority_id:null, ['class' => 'form-control required','id'=>'priority']) !!}
                        </div> 
                        <div class="form-group">
                            {!! Form::label('category', 'Category', ['class' => '']) !!}
                            {!! Form::select('category', $categories, ($ticket)? $ticket->category_id:null, ['class' => 'form-control required','id'=>'category']) !!}
                        </div>                     
                    </div>
                    <div class="box-footer">
                        <a href="{!!  url('/admin/tickets') !!}" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-primary pull-right" id="add-ticket">Save
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@stop
@section('footer-scripts')
    <script type="text/javascript" language="JavaScript">
        $(document).ready(function($) {
            $('#add-ticket').click(function () {
                $('#ticket_form').validate({
                    rules: {
                        content: {
                            required: true
                        }
                    },
                    errorPlacement: function (error, element) {
                        return error.insertAfter(element);
                    }
                });
                if ($('#ticket_form').valid()) {
                    $('#ticket_form').submit();
                }
            });
        });

    </script>
@stop
