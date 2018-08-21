@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            Update CMS Page
        </h1>
    </section>

    <section class="content">
        @include('admin.layout.notification')
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">General</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Meta</a></li>
                    </ul>
                    <div class="box box-primary">
                        {{ Form::model($page, array('method' => 'PATCH', 'url' => array('admin/page', $page->page_id),'class'=>'validate_form','id'=>'page_form','files' => true)) }}
                        <input type="hidden" name="url_id"
                               value="{!! ($page->url)?$page->url->sys_url_rewrite_id : '' !!}">
                        <div class="box-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="form-group english_input">
                                        {!! Form::label('en_page_title', 'Page Title', ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text('en_page_title',$page->english->page_title , ['class' => 'form-control required','id'=>'en_page_title','placeholder'=>"Page Title"]) !!}
                                    </div>
                                    <div class="form-group french_input hidden">
                                        {!! Form::label('fr_page_title', 'Page Title (French)', ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text('fr_page_title',(!empty($page->french)) ? $page->french->page_title : '.' , ['class' => 'form-control','id'=>'fr_page_title','placeholder'=>"Page Title(French)"]) !!}
                                    </div>

                                    <div class="form-group english_input">
                                        {!! Form::label('en_content_heading', 'Content Heading', ['class' => 'col-sm-2 control-label']) !!}</label>
                                        {!! Form::text('en_content_heading',$page->english->content_heading , ['class' => 'form-control required','id'=>'en_content_heading','placeholder'=>"Content Heading"]) !!}
                                    </div>
                                    <div class="form-group french_input hidden">
                                        {!! Form::label('fr_content_heading', 'Content Heading (French)', ['class' => 'col-sm-2 control-label']) !!}</label>
                                        {!! Form::text('fr_content_heading',(!empty($page->french))?$page->french->content_heading:'.'  , ['class' => 'form-control','id'=>'fr_content_heading','placeholder'=>"Content Heading(French)"]) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('url_key', 'URL Key', ['class' => 'col-sm-2 control-label']) !!}</label>
                                        {!! Form::text('url_key',($page->url->request_url)?$page->url->request_url:null , ['class' => 'form-control required','id'=>'url_key','placeholder'=>"Url key"]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('is_active', 'Is Active', ['class' => 'pull-left control-label']) !!}
                                        <div class="col-sm-10">
                                            {!! Form::checkbox('is_active', '1',($page->status==1)?true:false) !!}
                                        </div>
                                        <br>
                                    </div>
                                    <div class="form-group english_input">
                                        <label for="url_key">Content</label>
                                        <textarea class="textarea" name="en_content" id="en_content" placeholder="Page Content"
                                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                            {!! $page->english->content !!}
                                        </textarea>
                                    </div>

                                    <div class="form-group french_input hidden">
                                        <label for="url_key">Content (French)</label>
                                        <textarea class="textarea" name="fr_content" id="fr_content" placeholder="Page Content (French)"
                                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                            @if(!empty($page->french))
                                                {!! $page->french->content !!}
                                            @else 
                                                .
                                            @endif
                                        </textarea>
                                    </div>


                                </div>
                                <div class="tab-pane" id="tab_2">
                                    <div class="form-group">
                                        {!! Form::label('en_title', "Title", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("en_title", ($page)? $page->english->meta_title : null , ['class' => 'form-control','id'=>'en_title','placeholder'=>"Title"]) !!}
                                    </div>

                                    <div class="form-group hidden">
                                        {!! Form::label('fr_title', "Title (French)", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("fr_title", ($page)? $page->french->meta_title : '.', ['class' => 'form-control','id'=>'fr_title','placeholder'=>"Title (French)"]) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('en_meta_description', "Meta Description", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("en_meta_description",  ($page)? $page->english->meta_description : null , ['class' => 'form-control','id'=>'en_meta_description','placeholder'=>"Meta Description"]) !!}
                                    </div>

                                    <div class="form-group hidden">
                                        {!! Form::label('fr_meta_description', "Meta Description (French)", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("fr_meta_description", ($page)? $page->french->meta_description : '.' , ['class' => 'form-control','id'=>'fr_meta_description','placeholder'=>"Meta Description (French)"]) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('en_meta_keywords', "Meta Keyword", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("en_meta_keywords", ($page)? $page->english->meta_keywords : null , ['class' => 'form-control','id'=>'en_meta_keywords','placeholder'=>"Meta Keyword"]) !!}
                                    </div>
                                    <div class="form-group hidden">
                                        {!! Form::label('fr_meta_keywords', "Meta Keyword (French)", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("fr_meta_keywords",  ($page)? $page->french->meta_keywords : '.' , ['class' => 'form-control','id'=>'fr_meta_keywords','placeholder'=>"Meta Keyword (French)"]) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('en_og_title', "OG Title", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("en_og_title", ($page)? $page->english->og_title : null  , ['class' => 'form-control','id'=>'en_og_title','placeholder'=>"OG Title"]) !!}
                                    </div>

                                    <div class="form-group hidden">
                                        {!! Form::label('fr_og_title', "OG Title (French)", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("fr_og_title",  ($page)? $page->french->og_title : '.'  , ['class' => 'form-control','id'=>'fr_og_title','placeholder'=>"OG Title (French)"]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('en_og_description', "OG Description", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("en_og_description", ($page)? $page->english->og_description : null  , ['class' => 'form-control','id'=>'en_og_title','placeholder'=>"OG Description"]) !!}
                                    </div>
                                    <div class="form-group hidden">
                                        {!! Form::label('fr_og_description', "OG Description (French)", ['class' => 'col-sm-2 control-label']) !!}
                                        {!! Form::text("fr_og_description",  ($page)? $page->french->og_description : '.' , ['class' => 'form-control','id'=>'fr_og_title','placeholder'=>"OG Description (French)"]) !!}
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="box-footer">
                            <a href="{!! URL::to('admin/page') !!}" class="btn btn-default">Cancel</a>
                            <button type="submit" id="add-page" class="btn btn-primary pull-right">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('additional-styles')
    {!! Html::style('backend/plugins/redactor/redactor.css') !!}
    {!! Html::style('backend/plugins/redactor/plugins/alignment/alignment.css') !!}
    {!! Html::style('backend/plugins/redactor/plugins/clips/clips.css') !!}
@stop

@section('additional-scripts')
    {!! Html::script('backend/plugins/redactor/redactor.js') !!}
    {!! Html::script('backend/plugins/redactor/plugins/alignment/alignment.js') !!}
    {!! Html::script('backend/plugins/redactor/plugins/clips/clips.js') !!}
    {!! Html::script('backend/plugins/redactor/plugins/codemirror/codemirror.js') !!}
    {!! Html::script('backend/plugins/redactor/plugins/counter/counter.js') !!}
    {!! Html::script('backend/plugins/redactor/plugins/definedlinks/definedlinks.js') !!}
    {!! Html::script('backend/plugins/redactor/plugins/filemanager/filemanager.js') !!}
    {!! Html::script('backend/plugins/redactor/plugins/fontcolor/fontcolor.js') !!}
    {!! Html::script('backend/plugins/redactor/plugins/fontfamily/fontfamily.js') !!}
    {!! Html::script('backend/plugins/redactor/plugins/fontsize/fontsize.js') !!}
    {!! Html::script('backend/plugins/redactor/plugins/fullscreen/fullscreen.js') !!}
    {!! Html::script('backend/plugins/redactor/plugins/imagemanager/imagemanager.js') !!}
    {!! Html::script('backend/plugins/redactor/plugins/inlinestyle/inlinestyle.js') !!}
    {!! Html::script('backend/plugins/redactor/plugins/limiter/limiter.js') !!}
    {!! Html::script('backend/plugins/redactor/plugins/properties/properties.js') !!}
    {!! Html::script('backend/plugins/redactor/plugins/source/source.js') !!}
    {!! Html::script('backend/plugins/redactor/plugins/table/table.js') !!}
    {!! Html::script('backend/plugins/redactor/plugins/textdirection/textdirection.js') !!}
    {!! Html::script('backend/plugins/redactor/plugins/textexpander/textexpander.js') !!}
    {!! Html::script('backend/plugins/redactor/plugins/video/video.js') !!}
    {!! Html::script('backend/js/page.js') !!}
@stop
@section('footer-scripts')
@stop