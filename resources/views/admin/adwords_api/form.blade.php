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
                    {!! Form::open(['url' => ($adwords_api) ? Url("partner/adwords_api/$adwords_api->adwords_api_id") :  route("adwords_api.store"), 'class' => '','id' =>'adwords_api_form','method'=>($adwords_api)?'PATCH':'POST']) !!}
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('name', 'Acount name', ['class' => '']) !!}
                            {!! Form::text('name', ($adwords_api)? $adwords_api->name:null, ['class' => 'form-control required','id'=>'name','placeholder'=>"Name"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('adwords_developper_token', 'ADWORDS DEVELOPER TOKEN', ['class' => '']) !!}
                            {!! Form::text('adwords_developper_token', ($adwords_api)? $adwords_api->adwords_developper_token:null, ['class' => 'form-control required','id'=>'adwords_developper_token','placeholder'=>"ADWORDS DEVELOPER TOKEN"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('adwords_client_id', 'ADWORDS CLIENT ID', ['class' => '']) !!}
                            {!! Form::text('adwords_client_id', ($adwords_api)? $adwords_api->adwords_client_id:null, ['class' => 'form-control required','id'=>'adwords_client_id','placeholder'=>"ADWORDS CLIENT ID"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('adwords_client_secret', 'ADWORDS CLIENT SECRET', ['class' => '']) !!}
                            {!! Form::text('adwords_client_secret', ($adwords_api)? $adwords_api->adwords_client_secret:null, ['class' => 'form-control required','id'=>'adwords_client_secret','placeholder'=>"ADWORDS CLIENT SECRET"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('adwords_client_refresh_token', 'ADWORDS CLIENT REFRESH TOKEN', ['class' => '']) !!}
                            {!! Form::text('adwords_client_refresh_token', ($adwords_api)? $adwords_api->adwords_client_refresh_token:null, ['class' => 'form-control required','id'=>'adwords_client_refresh_token','placeholder'=>"ADWORDS CLIENT REFRESH TOKEN"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('adwords_client_customer_id', 'ADWORDS CLIENT CUSTOMER ID', ['class' => '']) !!}
                            {!! Form::text('adwords_client_customer_id', ($adwords_api)? $adwords_api->adwords_client_customer_id:null, ['class' => 'form-control required','id'=>'adwords_client_customer_id','placeholder'=>"ADWORDS CLIENT CUSTOMER ID"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('adwords_user_agent', 'ADWORDS USER AGENT', ['class' => '']) !!}
                            {!! Form::text('adwords_user_agent', ($adwords_api)? $adwords_api->adwords_user_agent:null, ['class' => 'form-control required','id'=>'adwords_user_agent','placeholder'=>"ADWORDS USER AGENT"]) !!}
                        </div>
                        
                        <div class="form-group">
                            {!! Form::label('is_default', 'Is default', ['class' => 'pull-left control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::checkbox('is_default', '1',($adwords_api && $adwords_api->is_default=='1') ? true: false) !!}
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
                        name: {
                            required: true
                        },
                        adwords_developper_token: {
                            required: true
                        },
                        adwords_client_id: {
                            required: true
                        },
                        adwords_client_secret: {
                            required: true
                        },
                        adwords_client_refresh_token: {
                            required: true
                        },
                        adwords_client_customer_id: {
                            required: true
                        },
                        adwords_user_agent: {
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