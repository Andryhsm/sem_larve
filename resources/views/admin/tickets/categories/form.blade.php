@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            @if($categories)
                Update category
            @else
                Add category
            @endif
        </h1>
    </section>
    <section class="content">
        @include('admin.layout.notification')

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    {!! Form::open(['url' => ($categories) ? Url("admin/tickets/categories/$categories->id") :  route("categories.store"), 'class' => '','id' =>'category_form','method'=>($categories)?'PATCH':'POST']) !!}
                    <div class="box-body">
                         <div class="" style="width:50%; margin: auto;">
                            <div class="form-group">
                                {!! Form::label('name_en', 'Name', ['class' => '']) !!}
                                {!! Form::text('name_en', ($categories)? $categories->english->name:null, ['class' => 'form-control required','id'=>'name_en','placeholder'=>"Name"]) !!}
                            </div>
                            <div class="form-group hidden">
                                {!! Form::label('name_fr', 'French name', ['class' => '']) !!}
                                {!! Form::text('name_fr', ($categories)? $categories->french->name:'.', ['class' => 'form-control required','id'=>'name_fr','placeholder'=>"French name"]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('color', 'Color', ['class' => '']) !!}
                                <div class="color_picker ">
                                    <div class="input-group colorpicker">
                                        <input type="text" name="color" value="{!! ($categories) ? $categories->color:'' !!}"
                                               class="form-control" placeholder="Color">
                                        <div class="input-group-addon">
                                            <i></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="radio">
                                    <label><input type="radio" name="type" value="1" {!! ($categories)?(($categories->type == "1")? "checked":""):"" !!}>CONTACT PAGE ONLY</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="type" value="2" {!! ($categories)?(($categories->type == "2")? "checked":""):"" !!}>TICKET SYSTEM ONLY</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="type" value="3" {!! ($categories)?(($categories->type == "3")? "checked":""):"checked" !!}>AVAILABLE IN TICKET AND CONTACT</label>
                                </div>
                            </div>    
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{!!  url('/admin/tickets/categories') !!}" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-primary pull-right" id="add-category">Save
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
            $('#add-category').click(function () {
                $('#category_form').validate({
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
                if ($('#category_form').valid()) {
                    $('#category_form').submit();
                }
            });
            $document.find(".colorpicker").colorpicker();
        });

    </script>
@stop
