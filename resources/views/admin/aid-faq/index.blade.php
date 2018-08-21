@extends('admin.layout.master')

@section('content')
    <div class="section-element-area">
        <div class="faq-content">
            <div class="col-lg-12">
                <div class="faq">
                    <div class="faq-title text-center" style="margin-bottom: -10px; ">
                        <h2>FAQ</h2>
                    </div>
                    <div class="collapses-group">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <?php $inc = 1; ?>
                            @foreach($faqs as $index=>$faq)
                            <div class="panel panel-default" id="faq{!! $faq->id !!}" onclick="activate(this);">
                                <?php 
                                    $class = "";
                                    $class = ($inc%2 == 1) ? "left-arrow" : "right-arrow"; 
                                ?>
                                <div class="panel-heading {!! $class !!}" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse{!! $faq->id !!}" aria-expanded="true" aria-controls="collapse{!! $faq->id !!}">
                                            {!! $faq->byLanguage(1,'question') !!}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse{!! $faq->id !!}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{!! $faq->id !!}">
                                    <div class="panel-body">
                                        {!! $faq->byLanguage(1,'answer') !!}
                                    </div>
                                </div>
                            </div>
                            <?php $inc++;?>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
