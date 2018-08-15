@extends('front.layout.master')
@section('content')
<div class="container coupon-container">
    <div class="section-title-area ptb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title position text-center">
                        <h2>{!! $item_request->merchant->first_name.' '.$item_request->merchant->last_name !!}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="section-element-area pb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="coloum-content text-center">
                        <h2>{!! trans('order.brand_of_product')." ".(($item_request->orderItem->brand->parent_id==null) ? $item_request->orderItem->brand->brand_name : $item_request->orderItem->brand->parent->brand_name) !!}</h2>
                        <h2>{!! trans('order.model')." ".$item_request->orderItem->product_name !!}</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="coloum-content text-center">
                        @foreach($item_request->orderItem->attributes as $index=>$attribute)
                            <h2>{!! $attribute->attribute_label !!}: {!! $attribute->attribute_selected_value !!}</h2>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-element-area pb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="coloum-content text-center">
                        <p>{!! trans('order.coupon_info') !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-title-area pb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h3>{!! format_price($coupon->amount) !!}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-element-area pb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="coloum-content text-center">
                        <p>{!! trans('order.coupon_available').' '.$coupon->expiry_date !!}</p>
                        <p><i>{!! trans('order.coupon_extended') !!}</i></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-element-area pb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="coloum-content text-center">
                        <h4>{!! trans('order.authorized_by').$item_request->merchant->first_name.' '.$item_request->merchant->last_name !!}</h4>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="coloum-content text-center">
                        <h4>{!! trans('order.confirm_number').' '.$coupon->coupon_code !!}</h4>
                   </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-element-area pb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="coloum-content text-center">
                        <p>{!! trans('order.payment_by') !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-element-area pb-30">
        <div class="container conditions">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="coloum-content">
                        <h3>{!! trans('order.condition') !!}</h3>
                        <p>{!! trans('order.first_condition') !!}</p>
                        <p>{!! trans('order.second_condition') !!}</p>
                        <p>{!! trans('order.third_condition') !!}</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="coloum-content">
                        <h3>{!! trans('order.how_to_use') !!}</h3>
                        <p>{!! trans('order.use_first') !!}</p>
                        <p>{!! trans('order.use_second') !!}</p>
                        <p>{!! trans('order.use_third') !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop