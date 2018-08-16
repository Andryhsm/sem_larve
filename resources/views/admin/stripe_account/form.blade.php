@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            @if($stripe_account)
                Update Stripe Account
            @else
                Add Stripe Account
            @endif
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    {!! Form::open(['url' => ($stripe_account) ? route('stripe_account.update', ['id' => $stripe_account->stripe_account_id]) :  route('stripe_account.store'), 'class' => '','id' =>'attribute_set_form', 'method' => ($stripe_account) ? 'PATCH' : 'POST']) !!}
                    <form role="form" method="post" action="/">
                        <div class="box-body">
                            <div class="form-group row">
                                {!! Form::label('is_active', 'Is Active', ['class' => 'col-sm-1 control-label']) !!}
                                <div class="">
                                    {!! Form::checkbox('is_active', '1',($stripe_account) ? ($stripe_account->is_active==1)?true:false :  false ) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('stripe_account_name', 'Account name', ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-6">
                                    {!! Form::text('stripe_account_name', ($stripe_account)? $stripe_account->stripe_account_name :null, ['class' => 'form-control required','id'=>'stripe_account_name','placeholder'=>"Stripe account name"]) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('publishable_key', 'Publishable key', ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-6">    
                                    {!! Form::text('publishable_key', ($stripe_account)? $stripe_account->publishable_key:null, ['class' => 'form-control col-sm-6 required','id'=>'publishable_key','placeholder'=>"Publishable key"]) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('secret_key', 'Secret key', ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-6">    
                                    {!! Form::text('secret_key', ($stripe_account)? $stripe_account->secret_key:null, ['class' => 'form-control required col-sm-6','id'=>'secret_key','placeholder'=>"secret key"]) !!}
                                </div>
                            </div>
                            
                        </div>
                        <div class="box-footer">
                            <a href="{!! route('stripe_account.index') !!}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-primary pull-right" id="add-attribute-set">Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop
@section('footer-scripts')
    {!! Html::script('backend/js/attribute_set.js') !!}
@stop