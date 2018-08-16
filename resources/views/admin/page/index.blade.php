@extends('admin.layout.master')

@section('content')
<div class="container">
    <section class="section-element-area pt-20 ajust">
        <div class="row">
            
            {!! $page->english->content !!}
            
        </div>
    </section>
</div>    
@stop
