@extends('front.layout.master')

@section('content')

	<?php Session::put('role_user',1); ?>
	      <div class="container">
            <div role="tabpanel" class="tab-panel col-lg-8 col-xs-12 col-md-10 col-sm-10">	              
            	@include('front.auth.login', ['role_id' => 1])
            	<button type="button" class="close" href="javascript:history.back()" aria-label="Close">
                    
            </div>
        </div>
@stop