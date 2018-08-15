@extends('front.customer.layout.master')

@section('content')
    <div class="box-body">
    	@include('front.customer.aid-faq.index')
        <div class="inner-content col-lg-12">
        	
    		<div role="tabpanel" class="tab-panel">
    			<div class="faq-title text-center" style="margin-bottom: -13px;">
                    <h2 class="mt--60">SUPPORT</h2>
                </div>
                <ul class="nav nav-tabs" style="font-size: 17px !important;" role="tablist">
                    <li role="presentation" class="active"><a href="#uploadTab" aria-controls="uploadTab" role="tab" data-toggle="tab">{!! trans('tickets.new_ticket') !!}</a>

                    </li>
                    <li role="presentation"><a href="#browseTab" aria-controls="browseTab" role="tab" data-toggle="tab">{!! trans('tickets.my_tickets') !!}</a>

                    </li>
                    <button type="button" class="close" href="javascript:history.back()" aria-label="Close">
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="uploadTab">
                    	@include('front.customer.tickets.form', ['categories' => $categories, 'priorities' => $priorities])
                    </div>
                    <div role="tabpanel" class="tab-pane" id="browseTab">
                    	@include('front.customer.tickets.lists', ['tickets' => $tickets])
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@stop
@section('additional-css')
<style type="text/css">
    
</style>
@endsection
@section('additional-script')

	<script type="text/javascript">
		if ($(".textarea").length > 0) {

        	$(".textarea").wysihtml5();
        }
	</script>
@endsection
