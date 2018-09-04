@extends($layout)
@section('additional-styles')
    {!! Html::style('backend/plugins/jqueryFileTree/jqueryFileTree.css') !!}
@stop
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box"> 
                    <div class="box-header">
                        <h3 class="box-title">Data Directory</h3>
                    </div>
                    <div class="box-body"> 

                    </div>
                </div>
            </div>
        </div>
@endsection
@section('additional-scripts')
    {!! Html::script('backend/plugins/jquery-easing/jquery.easing.1.3.js') !!}
    {!! Html::style('backend/plugins/jqueryFileTree/jqueryFileTree.js') !!}
@stop

