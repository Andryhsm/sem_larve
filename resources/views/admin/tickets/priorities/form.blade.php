@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            @if($priorities)
                Update priority
            @else
                Add priority
            @endif
        </h1>
    </section>
    <section class="content">
        @include('admin.layout.notification')

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    {!! Form::open(['url' => ($priorities) ? Url("admin/tickets/priorities/$priorities->id") :  route("priorities.store"), 'class' => '','id' =>'priority_form','method'=>($priorities)?'PATCH':'POST']) !!}
                    <div class="box-body">
                         <div class="" style="width:50%; margin: auto;">
                            <div class="form-group">
                                {!! Form::label('name_en', 'English name', ['class' => '']) !!}
                                {!! Form::text('name_en', ($priorities)? $priorities->english->name:null, ['class' => 'form-control required','id'=>'name_en','placeholder'=>"English name"]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('name_fr', 'French name', ['class' => '']) !!}
                                {!! Form::text('name_fr', ($priorities)? $priorities->french->name:null, ['class' => 'form-control required','id'=>'name_fr','placeholder'=>"French name"]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('color', 'Color', ['class' => '']) !!}
                                <div class="color_picker ">
                                    <div class="input-group colorpicker">
                                        <input type="text" name="color" value="{!! ($priorities) ? $priorities->color:'' !!}"
                                               class="form-control" placeholder="Color">
                                        <div class="input-group-addon">
                                            <i></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{!!  url('/admin/tickets/priorities') !!}" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-primary pull-right" id="add-priority">Save
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@stop
@section('additional-styles')
    {!! Html::style('backend/plugins/colorpicker/bootstrap-colorpicker.css') !!}
@stop

@section('additional-scripts')
    {!! Html::script('backend/plugins/colorpicker/bootstrap-colorpicker.js') !!}
    {!! Html::script('backend/js/attribute.js') !!}
@stop
@section('footer-scripts')
    <script type="text/javascript" language="JavaScript">
        $(document).ready(function($) {
            $('#add-priority').click(function () {
                $('#priority_form').validate({
                    rules: {
                        name_en: {
                            required: true
                        },
                        name_fr: {
                            required: true
                        }
                    },
                    errorPlacement: function (error, element) {
                        return error.insertAfter(element);
                    }
                });
                if ($('#priority_form').valid()) {
                    $('#priority_form').submit();
                }
            });
            $document.find(".colorpicker").colorpicker();
        });

    </script>
@stop