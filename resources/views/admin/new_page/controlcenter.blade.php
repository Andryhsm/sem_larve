@extends($layout)

@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
@stop
@section('content')
    <section class="content-header">
        <h1>
            CONTROL CENTER
        </h1>
        
    </section>

    <section class="content">
        @include('admin.layout.notification')
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Add batch of products</h3>
                    </div>
                    <div class="box-body">
                        body control center
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop