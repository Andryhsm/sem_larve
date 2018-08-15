@extends($layout)

@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
@stop
@section('content')
    <section class="content-header">
        <h1>
            Product Adjustment
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Product Adjustment</h3>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Original Price</th>
                                <th>Better Price</th>
                                <th>Merchant Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($product_prices as $product_price)
                             <tr>
                                <td>{!! $product_price->product->product_name !!}</td>
                                <td>${!! $product_price->original_price !!}</td>
                                <td>${!! $product_price->base_price !!}</td>
                                <td>{!! $product_price->user->first_name." ".$product_price->user->last_name !!}</td>

                            </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="search-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Search Product</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="/">
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Product Name</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Search</button>
                </div>
            </div>
        </div>
    </div>


@stop
@section('additional-scripts')
    {!! Html::script('backend/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('backend/plugins/datatables/dataTables.bootstrap.min.js') !!}
@stop
@section('footer-scripts')
    {!! Html::script('backend/js/product_price_adjustment.js') !!}
@stop
