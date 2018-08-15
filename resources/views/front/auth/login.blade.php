{{-- @extends('front.layout.master') --}}
        
     <div class="account-area ">
           
        <div class="row">
            <div class="col-lg-12">
                @include('notification')
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="login-area">
                    <!-- div class="section-title mb-20">
                        <h2>{!! trans("form.member_login")!!}</h2>
                    </div -->
                    <p></p>
                    {!! Form::open(['url' => url(LaravelLocalization::getCurrentLocale().'/login'), 'id'=>'login_form', 'method' => 'post', 'role' => 'form' ,'class'=>'form-horizontal','autocomplete'=>'off']) !!}
                    <div class="form-group row mb-0">
                         <label for="username" class="col-sm-3 ml-50 mr--50 col-form-label">{!! trans("form.email_address")!!} *</label>
                         <div class="col-sm-8">
                            {{ Form::text('email', '',['class'=>"required form-control"]) }}
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                         <label for="password" class="col-sm-3 ml-50 mr--50 col-form-label">{!! trans("form.password")!!} *</label>
                        <div class="col-sm-8">
                            {{ Form::password('password',['class'=>"required form-control"]) }}
                        </div>
                    </div>
                    <div class="checkbox mg-18 check-merchant-left">
                        <label for="rememberme">
                            <input type="checkbox" name='memoty'>&nbsp;
                            {!! trans("form.remember")!!}
                        </label>
                    </div>    

                    <!-- <a href="{{ url(LaravelLocalization::getCurrentLocale().'/forgot-password') }}">{!! trans("form.forgot_password")!!} ? </a> -->
                    <div class="text-center">
                            <button type="submit" id="login-btn">{!! trans("form.login")!!}</button>
                    </div>
                    {{Form::close()}}
                </div>
                <!-- login-area-end -->
            </div>
        </div>
                    
            
    </div>


