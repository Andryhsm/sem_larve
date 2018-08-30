@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            @if($admin)
                Update Partner                
            @else
                Add New Partner
            @endif
        </h1>
    </section>
    <?php Session::put('partner_account', 'yes'); ?>
    <section class="content">
        @include('admin.layout.notification')
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    {!! Form::open(array('url' => ($admin) ? "admin/customer/$admin->admin_id" :route('customer.store'),'files' => true,'class'=>'','id'=>'admin_user_form','method'=>($admin)?'PATCH':'POST')) !!}
                    <div class="box-body">
                         @if(!$admin || ($admin && $admin->type==3))
                            <div class="form-group">
                                <span>Sub-account of</span> <strong>{!! $parent_admin->email !!}</strong> <span>( {!! $parent_admin->last_name !!} {!! $parent_admin->first_name !!} )</span> 
                            </div>
                        @endif
                        <div class="form-group">
                            {!! Form::label('first_name', 'First Name') !!}
                            {!! Form::text('first_name',($admin) ? $admin->first_name : null , ['class' => 'form-control required','id'=>'first_name','placeholder'=>"First Name"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('last_name', 'Last Name') !!}
                            {!! Form::text('last_name',($admin) ? $admin->last_name : null , ['class' => 'form-control required','id'=>'last_name','placeholder'=>"Last Name"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('email_address', 'Email Address') !!}
                            {!! Form::text('email',($admin) ? $admin->email : null , ['class' => 'form-control required','id'=>'email','placeholder'=>"Email Address"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password', 'Password') !!}
                            {!! Form::password('password',['class' => 'form-control','id'=>'password','placeholder'=>"Password"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('confirm_password', 'Confirm Password') !!}
                            {!! Form::password('confirm_password',['class' => 'form-control','id'=>'confirm_password','placeholder'=>"Confirm Password"]) !!}
                        </div>
                        @if(!$admin || ($admin && $admin->type!=3))
                            <div class="form-group">
                                {!! Form::label('role_id', 'Role') !!}
                                {!! Form::select('role_id', $roles,($admin) ? $admin->role_id : null,['class'=>'form-control ','id'=>'']) !!}

                            </div>
                        @endif
                       
                        <div class="form-group">
                            {!! Form::label('profile_image','Profile Image') !!}
                            {!! Form::file('profile_image',array('class'=>'form-control', 'placeholder'=>'Profile Image')) !!}
                            @if($admin)
                                <img src="{!! Url("upload/profile/$admin->profile_image") !!}" class="brand-image">
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="is_active">Is Active</label>
                            <div class="checkbox">
                                {!! Form::checkbox('is_active', '1',($admin && $admin->is_active=='1') ? true: false) !!}
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{!! route('customer.index') !!}" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-primary pull-right" id="add-admin">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop
@section('additional-scripts')
    {!! Html::script('backend/js/admin_user.js') !!}
@stop
