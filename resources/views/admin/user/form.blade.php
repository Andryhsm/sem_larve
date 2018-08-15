@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            Add New Account
        </h1>
    </section>

    <section class="content">
        @include('admin.layout.notification')
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(array('url' => 'admin/'.$type,'files' => true,'class'=>'user-form form-horizontal','id'=>'account_form')) !!}

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Information</a></li>
                        @if($type=='customer')
                            <li><a href="#tab_2" data-toggle="tab">Address</a></li>
                        @endif
                    </ul>
                    <input type="hidden" name="type" value="{!! $type !!}">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <section class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="page_title">First
                                                    Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="first_name" class="form-control required"
                                                           id="page_title"
                                                           placeholder="First Name">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="content-heading">Last
                                                    Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="last_name" class="form-control required"
                                                           id="content-heading"
                                                           placeholder="Last Name">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="url_key">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="email" class="form-control required"
                                                           id="url_key"
                                                           placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="url_key">Password</label>
                                                <div class="col-sm-10">
                                                    <input type="password" name="password" class="form-control"
                                                           id="password"
                                                           placeholder="Password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="confirm_password">Confirm
                                                    Password</label>
                                                <div class="col-sm-10">
                                                    <input type="password" name="confirm_password"
                                                           class="form-control required"
                                                           id="confirm_password"
                                                           placeholder="Confirm Password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="is_active">Is Active</label>
                                                <div class="col-sm-10 checkbox">
                                                    {!! Form::checkbox('is_active', '1',false) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('profile_image','Profile Image',array('class' => 'col-sm-2 control-label')) !!}
                                                <div class="col-sm-10">
                                                    {!! Form::file('profile_image',array('class'=>'form-control', 'placeholder'=>'Confirm Password')) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone_number" class="col-sm-2 control-label">Phone Number</label>
                                                <div class="col-sm-10">
                                                    {!! Form::text('phone_number',null,array('class'=>'form-control required', 'placeholder'=>'Phone Number')) !!}
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="radius">Radius Of Research (KM)</label>
                                                <div class="col-sm-10">
                                                    {!! Form::select('radius', getRadiusData(), null,['class'=>'form-control']) !!}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="tab-pane" id="tab_2">
                            <section class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="address1">Address1</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="address1"
                                                           class="form-control required"
                                                           id="address1"
                                                           placeholder="Address1">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="address2">Address2</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="address2"
                                                           class="form-control required"
                                                           id="address2"
                                                           placeholder="Address2">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="company">Company Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="company" class="form-control required"
                                                           id="company"
                                                           placeholder="Company">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="city">City</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="city"
                                                           class="form-control required"
                                                           id="city"
                                                           placeholder="City">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="zip">Zip/Postal Code</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="zip"
                                                           class="form-control required"
                                                           id="zip"
                                                           placeholder="Zip/Postal Code">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="country">State</label>
                                                <div class="col-sm-10">
                                                    <select name="state_id" id="state" class="form-control required">
                                                        <option value="">Select State</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="country">Country</label>
                                                <div class="col-sm-10">
                                                    <select name="country_id" id="country"
                                                            class="form-control required">
                                                        <option value="">Select Country</option>
                                                        @foreach($countries as $country)
                                                            <option value="{!! $country->id !!}">{!! $country->name !!}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="box-footer">
                            <a href="{!! URL::to('admin/'.$type) !!}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-primary pull-right" id="add-account">Save</button>
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@stop
@section('additional-scripts')
    {!! Html::script('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') !!}
    {!! Html::script('backend/js/account.js') !!}
@stop
@section('footer-scripts')
    <script>
        var selected_state_id = '';
        var selected_country_id = '';
    </script>
@stop