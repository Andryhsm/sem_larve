@extends('admin.layout.empty')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <!-- img src="{!! url('backend/img/logo-altee-bleu.svg') !!}" -->
            <h1>LaFactorySEM</h1>
        </div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
            {!! Form::open(array('url'=>url('admin/login'),'method'=>'POST','class'=>'validate_form')) !!}
                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control required" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control required" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="memory" value="1"> Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat save-form">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            {!! Form::close() !!}

            <a href="#">I forgot my password</a>
        </div>
        <!-- /.login-box-body -->
    </div>

@stop