@extends($layout)

@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
    {!! Html::style('backend/plugins/colorpicker/bootstrap-colorpicker.css') !!}
@stop
@section('content')
    <section class="content-header">
        <h1>
            Tickets&Contacts list
        </h1>
        <div class="header-btn">
            <div class="clearfix">
                <div class="btn-group inline pull-left">
                    <!-- <div class="btn btn-small">
                        <a href="{!! url('/admin/tickets/create') !!}" class="btn btn-block btn-primary">Create new ticket</a>
                    </div> -->
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        @include('admin.layout.notification')
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="hidden">Id</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Subject</th>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Priority</th>                                
                                <th>Category</th>
                                <th class="no-sort" width="10%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets->data as $ticket)
                                <tr style="background-color: {!! ($ticket->status_id != null) ? $ticket->status->color : "#f2c113"; !!} !important;">
                                    <td class="hidden">{!! $ticket->id !!}</td>
                                    <td>{!! $ticket->type !!}</td>
                                    <td>
                                        <span class="badge mr-5" style="background-color: {!! ($ticket->status_id != null) ?$ticket->status->color:"#ffffff"; !!} !important;">{!! ($ticket->status_id != null) ? $ticket->status->english->name:"" !!}
                                        </span>
                                    </td>
                                    <td>{!! $ticket->subject !!}</td>
                                    <td>{!! $ticket->name !!}</td>
                                    <td>{!! $ticket->email !!}</td>                                  
                                    <td>
                                        <span class="badge mr-5" style="background-color: {!! ($ticket->priority_id != null) ?$ticket->priority->color:"#ffffff"; !!} !important;">{!! ($ticket->priority_id != null) ? ($ticket->priority->english->name) : "" !!}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge mr-5" style="background-color: {!! ($ticket->category)?$ticket->category->color:''; !!} !important;">{!! ($ticket->category)?$ticket->category->english->name:'' !!}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{!! Url("admin/tickets/$ticket->id") !!}"
                                               class="btn btn-default btn-sm" title="Show"><i
                                                        class="fa fa-fw fa-edit"></i></a>
                                        {!! Form::open(array('url' => 'admin/tickets/' . $ticket->id, 'class' => 'pull-right')) !!}
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                        {!! Form::button('<i class="fa fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn delete-btn btn-default btn-sm','title'=>'Delete'] ) !!}
                                            {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section> 
@stop

@section('additional-scripts')
    {!! Html::script('backend/plugins/datatables/jquery.dataTables.js') !!}
    {!! Html::script('backend/plugins/datatables/dataTables.bootstrap.min.js') !!}
@stop
@section('footer-scripts')
<script>
    if (jQuery('table.table').length > 0) {
        jQuery('table.table').DataTable({
            "responsive": true,
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": true,
            "bAutoWidth": false,
            "order": [[0, "desc"]],
            "lengthMenu": [20, 40, 60, 80, 100],
            "pageLength": 20,
            columns: [
                {searchable: false, sortable: false},
                {searchable: true, sortable: true},
                {searchable: true, sortable: true},
                {searchable: true, sortable: true},
                {searchable: true, sortable: true},
                {searchable: false, sortable: false},
                {searchable: false, sortable: true},
                {searchable: false, sortable: true},
                {searchable: false, sortable: false}
            ],
            fnDrawCallback: function () {
                var $paginate = this.siblings('.dataTables_paginate');
                if (this.api().data().length <= this.fnSettings()._iDisplayLength) {
                    $paginate.hide();
                }
                else {
                    $paginate.show();
                }
            }
        });
    }

    if (jQuery('.dataTables_filter').length > 0) {
        jQuery('.dataTables_filter').find('input').addClass('form-control')
    }
</script>
@stop
