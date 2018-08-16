@extends($layout)

@section('content')
    @include('admin.layout.notification')
    <section class="content-header">
        <h1>
            User Profile
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle"
                             src="{!! $user->getProfileImage() !!}" alt="User profile picture">
                        <h3 class="profile-username text-center">{!! $user->first_name !!} {!! $user->last_name !!}</h3>
                        <p class="text-muted text-center">{!! ($user->type == 1 ? 'Administrator' : 'Subscribe') !!}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="settings">
                            {{--{!! Form::open(array('url'=>route('profile'),'method'=>'post', 'class'=>'form-horizontal')) !!}--}}
                            {!! Form::model($user, ['method'=>'PATCH', 'route' => ['profile.update',$user->admin_id ], 'id' => 'profile_update', 'class' => 'form-horizontal validate_form','files' => true]) !!}

                            <div class="form-group">
                                {!! Form::label('first_name','First Name',array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('first_name', $user->first_name,array('class'=>'form-control required', 'placeholder'=>'First Name')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('last_name','Last Name',array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('last_name',null ,array('class'=>'form-control required', 'placeholder'=>'Last Name')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('email','Email',array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('email',null,array('class'=>'form-control required', 'placeholder'=>'Email')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('password','Password',array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-10">
                                    {!! Form::password('password',array('class'=>'form-control', 'placeholder'=>'Password')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('profile_image','Profile Image',array('class' => 'col-sm-2 control-label')) !!}
                                <div class="col-sm-10">
                                    {!! Form::file('profile_image',array('class'=>'form-control ', 'placeholder'=>'Confirm Password')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('is_active', 'Is Active', ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::checkbox('is_active', '1') !!}
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger save-form">Submit</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop