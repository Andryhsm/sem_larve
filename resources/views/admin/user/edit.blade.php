@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            Update Account
        </h1>
    </section>

    <section class="content">
        @include('admin.layout.notification')
        <div class="row">
            <div class="col-md-12">
                {!! Form::model($users, array('method' => 'PATCH', 'url' => array('admin/'.$type, $users->user_id),'class'=>'user-form form-horizontal','id'=>'account_form','files' => true))!!}

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Information</a></li>
                        <li class="hidden"><a href="#tab_2" data-toggle="tab">Address</a></li>
                    </ul>
                    <input type="hidden" name="type" value="{!! $type !!}">
                    <input type="hidden" name="type" value="{!! $type !!}">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <section class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-body">
                                            <div class="form-group hidden">
                                                <label for="page_title" class="col-sm-2 control-label">First
                                                    Name</label>
                                                <div class="col-sm-10">
                                                    {!! Form::text('first_name',$users->first_name,array('class'=>'form-control required', 'placeholder'=>'Last Name')) !!}
                                                </div>

                                            </div>
                                            <div class="form-group hidden">
                                                <label for="content-heading" class="col-sm-2 control-label">Last
                                                    Name</label>
                                                <div class="col-sm-10">
                                                    {!! Form::text('last_name',$users->last_name ,array('class'=>'form-control required', 'placeholder'=>'Last Name')) !!}
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label for="url_key" class="col-sm-2 control-label">Email</label>
                                                <div class="col-sm-10">
                                                    {!! Form::text('email_address',$users->email ,array('class'=>'form-control required', 'placeholder'=>'Last Name')) !!}
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label for="password" class="col-sm-2 control-label">Password</label>
                                                <div class="col-sm-10">
                                                    <input type="password" name="password" class="form-control"
                                                           id="password"
                                                           placeholder="Password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="confirm_password" class="col-sm-2 control-label">Confirm
                                                    Password</label>
                                                <div class="col-sm-10">
                                                    <input type="password" name="confirm_password" class="form-control"
                                                           id="confirm_password"
                                                           placeholder="Confirm Password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="url_key" class="col-sm-2 control-label">Is Active</label>
                                                <div class="col-sm-10 checkout">
                                                    {!! Form::checkbox('is_active', '1',($users->status=='1')? true:false) !!}
                                                </div>
                                            </div>
                                            <div class="form-group hidden">
                                                {!! Form::label('profile_image','Profile Image',array('class' => 'col-sm-2 control-label')) !!}
                                                <div class="col-sm-10">
                                                    {!! Form::file('profile_image',array('class'=>'form-control', 'placeholder'=>'Confirm Password')) !!}
                                                    @if(isset($users->profile_image) && $users->profile_image!='')
                                                        {{ Form::image('upload/profile/'.$users->profile_image, null, ['class' => 'brand-image'])}}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group hidden">
                                                <label for="phone_number" class="col-sm-2 control-label">Phone Number</label>
                                                <div class="col-sm-10">
                                                    {!! Form::text('phone_number',$users->phone_number,array('class'=>'form-control required', 'placeholder'=>'Phone Number')) !!}
                                                </div>
                                            </div>

                                            <div class="form-group hidden">
                                                <label class="col-sm-2 control-label" for="radius">Radius Of Research (KM)</label>
                                                <div class="col-sm-10">
                                                    {!! Form::select('radius', getRadiusData(), $users->radius,['class'=>'form-control']) !!}
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
                                        <input type="hidden" name="user_address_id" value="{!! (count($users->address)>0) ? $users->address->user_address_id : '' !!}">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="address1">Address1</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="address1"
                                                           class="form-control required"
                                                           id="address1" value="{!! (count($users->address)>0) ? $users->address->address1:'' !!}"
                                                           placeholder="Address1">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="address2">Address2</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="address2"
                                                           class="form-control required"
                                                           value="{!! (count($users->address)>0) ? $users->address->address2:'' !!}"
                                                           id="address2"
                                                           placeholder="Address2">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="company">Company Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="company" class="form-control required"
                                                           id="company"
                                                           value="{!! (count($users->address)>0) ?$users->address->company:'' !!}"
                                                           placeholder="Company">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="city">City</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="city"
                                                           class="form-control required"
                                                           id="city"
                                                           value="{!! (count($users->address)>0) ? $users->address->city:'' !!}"
                                                           placeholder="City">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="zip">Zip/Postal Code</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="zip"
                                                           class="form-control required"
                                                           id="zip"
                                                           value="{!! (count($users->address)>0) ? $users->address->zip:'' !!}"
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
                                                            <option value="{!! $country->id !!}" {!! (count($users->address) > 0 && $users->address->country_id==$country->id) ? "selected":'' !!}>{!! $country->name !!}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        </div>
                        </div>
                    <div class="box-footer">
                        <a href="{!! url('admin/'.$type) !!}" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-primary pull-right" id="add-account">Save</button>
                    </div>
                </div>
                </form>
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
        var selected_state_id = '{!! (count($users->address) >0 && $users->address->state_id && $users->address->state_id!='') ? $users->address->state_id :'' !!}';
        var selected_country_id = '{!! (count($users->address) >0 && $users->address->country_id && $users->address->country_id!='') ? $users->address->country_id :'' !!}';
    </script>
@stop