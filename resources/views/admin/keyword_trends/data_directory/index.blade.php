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
                        <div data-url-script="{!! URL::to('backend/plugins/jqueryFileTree/connectors/jqueryFileTree.php') !!}" id="container_id">
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('additional-scripts')
    {!! Html::script('backend/plugins/jqueryFileTree/jqueryFileTree.js') !!}
    {!! Html::script('backend/plugins/jquery-easing/jquery.easing.1.3.js') !!}
    <script type="text/javascript">
    $(document).ready( function()
    {
         var script_url = $('#container_id').data('url-script');
            $('#container_id').fileTree({
                root: '/var/www/Factorysem/storage/data-keyword/',
                folderEvent: 'click',
                script: script_url,
                expandSpeed: 750,
                collapseSpeed: 750,
            },  function(file) {
                    open(file);
            });
    });
</script>
@stop

