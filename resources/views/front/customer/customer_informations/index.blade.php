@extends('front.customer.layout.master')
@section('content')   
    <section class="content-header">
        <h1>
            Customer
        </h1>
    </section>

    <section class="content">
        @include('admin.layout.notification')
        <div class="row">
            <div class="col-md-12">
            {!! Form::open(array('method' => 'post', 'id' =>
                    'userForm', 'url'=>url(LaravelLocalization::getCurrentLocale().'/manage-account'), 'class'=>'validate_form')) !!}   
            <div class="nav-tabs-custom">
                <div class="box-body">                                         
                        <div class="form-group">
                            <label for="civility" class="col-sm-2 control-label">{!! trans("customer.civility")!!}</label>
                            <div class="col-sm-10">
                                <button class="btn btn-primary btn-civility {!! ($customer->civility == 2 || $customer->civility == null) ? 'checked' : '' !!}" data-value="2">Mme</button>
                                <button class="btn btn-primary btn-civility {!! ($customer->civility == 1) ? 'checked' : '' !!}" data-value="1">M</button>
                                <input type="number" id="input_civility" class="hidden" name="civility">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">{!! trans("form.first_name")!!} <strong>*</strong></label>
                            <div class="col-sm-10">
                                {{ Form::text('first_name',$customer->first_name,['class'=>"form-control required"]) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="col-sm-2 control-label">{!!
                    trans("form.last_name")!!}<strong>*</strong></label>
                            <div class="col-sm-10">
                                {{ Form::text('last_name', $customer->last_name,['class'=>"form-control required"]) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">{!! trans("customer.email")!!}<strong>*</strong></label>
                            <div class="col-sm-10">
                                {{ Form::text('email', $customer->email,['class'=>"form-control required"]) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sms" class="col-sm-2 control-label">{!! trans("customer.phone")!!}<strong>*</strong></label>
                            <div class="col-sm-10">
                                {{ Form::text('phone', $customer->phone_number,['class'=>"form-control required"]) }}
                            </div>
                        </div>
                        @if($customer->role_id==1)
                        <div class="form-group">
                            <label for="radius" class="col-sm-2 control-label">{!! trans("customer.radius")!!}<strong>*</strong></label>
                            <div class="col-sm-3">
                                    {{ Form::select('radius',getRadiusData(), $customer->radius,['class'=>"required form-control"]) }}
                                </div>
                                <div class="area-item ">
                                    <label for="zip" class="zip col-sm-2 control-label">{!! trans("customer.around")!!}</label>
                                </div>
                                <div class="area-item zip col-sm-3">
                                    {{ Form::text('zip', (isset($customer->address) || count($customer->address)>0) ? $customer->address->zip : '',['class'=>"form-control required"]) }}
                                </div>
                            </div>
                        
                        @endif
                        <div class="form-group col-md-12 row">
                            <label for="language" class="col-sm-2 control-label">{!! trans("customer.language")!!}</label>
                            <div class="col-sm-10">
                                <button class="btn btn-primary btn-language {!! ($customer->language_id == 2) ? 'checked' : '' !!}" data-value="2">{!! trans("customer.french")!!}</button>
                                <button class="btn btn-primary btn-language {!! ($customer->language_id != 2 || $customer->language_id == null) ? 'checked' : '' !!}" data-value="1">{!! trans("customer.english")!!}</button>
                                <input type="number" id="input_language" class="hidden" name="language">
                            </div>
                        </div>
                    
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right" id="updateUserInfo">{!! trans('customer.update') !!}</button>
                </div>
                {{Form::close()}}
                </div>
            </div>
        </div>

    </section>
@endsection
@section('additional-styles')
<style type="text/css">
    .form-group {
        clear: both;
        content: '';
        display: flow-root;

    }
</style>
@stop