@extends($layout)

@section('content')
    <section class="content-header">
        <h1>
            @if($statuses)
                Update Status
            @else
                Add Status
            @endif
        </h1>

    </section>

    <section class="content">
        @include('admin.layout.notification')
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li><a href="#options" data-toggle="tab"></a></li>
                    </ul>   
                    {!! Form::open(['url' => ($statuses) ? route('statuses.update', ['id' => $statuses->id]) :  route('statuses.store'), 'class' => 'form-horizontal','id' =>'statuses_form', 'method' => ($statuses) ? 'PATCH' : 'POST' ]) !!}
                    <div class="tab-content">
                        <section class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-body">
                                            <div class="" style="width:50%; margin: auto;">
                                                <div class="form-group">
                                                    <label for="name_en" class="">Name</label>
                                                    <div class="">
                                                        <input type="text" value="{!! ($statuses) ? $statuses->english->name : '' !!}" class="form-control" name="name_en"/>
                                                    </div>
                                                </div>
                                                <div class="form-group hidden">
                                                    <label for="name_fr" class="">French name</label>
                                                    <div class="">
                                                        <input type="text" value="{!! ($statuses) ? $statuses->french->name : '.' !!}" class="form-control" name="name_fr"/>
                                                    </div>
                                                </div>
                                                <div class=" form-group">
                                                    <label for="name" class="">Color </label>
                                                    <div class="input-group colorpicker">
                                                        <input type="text" name="color"
                                                                   value="{!! ($statuses) ? $statuses->color : '' !!}"
                                                                   class="form-control">
                                                        <div class="input-group-addon">
                                                            <i></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        {!! Form::label('is_default', 'Is Default', ['class' => 'col-sm-2']) !!}
                                                        <div class="col-sm-5">
                                                            {!! Form::checkbox('is_default', '1',($statuses) ? ($statuses->is_default==1)?true:false :  false ) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </section>
                        </div>
                        <div class="box-footer">
                            <a href="{!! route('statuses.index') !!}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-primary pull-right" id="add-statuses">Save
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
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
