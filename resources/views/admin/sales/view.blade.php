@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            Order Detail
        </h1>
    </section>

    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> Order Id #{!! $order->order_id !!}
                    <small class="pull-right">Date: {!! convertDate($order->order_date) !!}</small>
                </h2>
            </div>
        </div>
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                Customer Detail
                <address>
                    <strong>{!! $order->customer->first_name.' '.$order->customer->last_name !!}</strong><br>
                    @if(count($order->billingAddress)>0)
                    {!! $order->billingAddress->address1 !!}<br>
                    {!! $order->billingAddress->city !!}, {!! $order->billingAddress->country_code !!} {!! $order->billingAddress->zip !!}<br>
                    @endif
                    Phone: {!! $order->customer->phone_number !!}<br>
                    Email: {!! $order->customer->email !!}
                </address>
            </div>

            <div class="col-sm-4 invoice-col">
                <b>Order #{!! $order->order_id !!}</b><br>
                <br>
                <b>Order ID:</b> {!! $order->order_id !!}<br>
                <b>Order Date:</b> {!! convertDate($order->order_date) !!}<br>
            </div>

            <div class="col-sm-4 invoice-col">
                {!! Form::open(['url' => Url("admin/sales/update-status/$order->order_id"), 'class' => 'form-horizontal','id' =>'order_form']) !!}
                <b>Current Order Status:</b> {!! $order->status->status_name !!} <br>
                <b>Status:</b>
                <select name="order_status" class="order_status" id="order_status">
                    @foreach($order_status as $status)
                        <option value="{!! $status->order_status_id !!}" {!! ($status->order_status_id==$order->order_status_id)?"selected":'' !!}>{!! $status->status_name !!}</option>
                    @endforeach
                </select><br>
                <br>
                <button type="submit" name="update_order" id="update_order" class="btn btn-primary hidden">Update Status</button>
                {!! Form::close() !!}
            </div>

        </div>
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Qty</th>
                        <th>Product</th>
                        <th>Serial #</th>
                        {{--<th>Description</th>--}}
                        <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->orderItems as $item)

                    <tr>
                        <td> {!! $item->quantity !!}</td>
                        <td>{!! $item->product_name !!}</td>
                        <td>{!! $item->product_sku !!}</td>
                        {{--<td>El snort testosterone trophy driving gloves handsome</td>--}}
                        <td>{!! getPrice($item->final_price) !!}</td>
                    </tr>
                  @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6">
                <p class="lead">Payment Methods:</p>
                @if($order->transaction)
                {!! $order->transaction->payment_method !!}
                @endif
            </div>
            <div class="col-xs-6">
                <p class="lead">Order Summary</p>

                <div class="table-responsive">
                    <table class="table">
                        <tr>

                            <th style="width:50%">Subtotal:</th>
                            <td>{!! getprice($order->subtotal) !!}</td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td>{!! getPrice($order->total) !!}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row no-print">
            <div class="col-xs-12">
                <a href="{!! url('admin/sales/'.Session::get('sales_status').'') !!}" class="btn btn-default pull-right">Back</a>
            </div>
        </div>
    </section>

@stop
@section('additional-scripts')
    {!! Html::script('backend/js/sales.js') !!}
@stop
