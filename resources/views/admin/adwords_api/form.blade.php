@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            @if($adwords_api)
                Update Account
            @else
                Add Account
            @endif
        </h1>
    </section>
    <section class="content">
        @include('admin.layout.notification')

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    {!! Form::open(['url' => ($adwords_api) ? Url("admin/adwords_api/$adwords_api->$adwords_apiid") :  route("adwords_api.store"), 'class' => '','id' =>'adwords_api_form','method'=>($adwords_api)?'PATCH':'POST']) !!}
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('english_question', 'Question', ['class' => '']) !!}
                            {!! Form::text('english_question', ($adwords_api)? $adwords_api->english_question:null, ['class' => 'form-control required','id'=>'english_question','placeholder'=>"Question"]) !!}
                        </div>
                        
                        <div class="form-group">
                            {!! Form::label('status', 'Is Active', ['class' => 'pull-left control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::checkbox('status', '1',($adwords_api && $adwords_api->status=='1') ? true: false) !!}
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{!! route('adwords_api.index') !!}" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-primary pull-right" id="add-adwords_api">Save
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
            $('#add-adwords_api').click(function () {
                $('#adwords_api_form').validate({
                    rules: {
                        english_answer: {
                            required: true
                        },
                        english_question: {
                            required: true
                        }
                    },
                    errorPlacement: function (error, element) {
                        return error.insertAfter(element);
                    }
                });
                if ($('#adwords_api_form').valid()) {
                    $('#adwords_api_form').submit();
                }
            });
        });

    </script>
@stop