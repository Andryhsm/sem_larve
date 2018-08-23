@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            Add New Role
        </h1>
    </section>
    <?php $types = array('1'=>'Administator','2'=>'Partner'); ?>
    <section class="content">
        @include('admin.layout.notification')
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    {!! Form::open(array('url' => 'admin/role','files' => true,'id'=>'admin_role','class'=>'validate_form')) !!}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="page_title">Role Name</label>
                                <input type="text" name="role_name" class="form-control required" id="page_title" placeholder="Role Name">
                            </div>
                            <div class="form-group">
                            {!! Form::label('type', 'Role type') !!}
                            {!! Form::select('type', $types, null,['class'=>'form-control ','id'=>'']) !!}

                        </div>
                            <div class="tab-pane" id="tab_3">
                                <label for="content-heading">Permission</label>
                                <div id="permission"></div>
                                <input type="hidden" name="permission_id" id="permission_id"
                                       value="">
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="{!! Url('admin/role') !!}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-primary pull-right save-form" id="add-role">Save</button>
                        </div>
                   {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@stop
@section('additional-styles')
    {!! Html::style('backend/plugins/dynatree/src/skin/ui.dynatree.css') !!}
    {!! Html::style('backend/plugins/dropzone/dropzone.css') !!}

@stop

@section('additional-scripts')
    {!! Html::script('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') !!}
    {!! Html::script('backend/plugins/dynatree/jquery/jquery-ui.custom.js') !!}
    {!! Html::script('backend/plugins/dynatree/src/jquery.dynatree.js') !!}

    {!! Html::script('backend/plugins/select2/select2.js') !!}
    {!! Html::script('backend/js/role.js') !!}

@stop
@section('footer-scripts')
    <script type="application/javascript" language="JavaScript">
        var category_tree_data = '{!! json_encode($categories['tree_data']) !!}';
        var selected_category = '[]';

    </script>

@stop