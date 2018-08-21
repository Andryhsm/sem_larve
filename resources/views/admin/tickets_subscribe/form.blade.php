        <form class="validate_form" method="POST" action="{!! route('tickets-subscribe-store-partner') !!}">
                    <div class="form-group">
                        <label for="subject">{!! trans('tickets.subject') !!}</label>
                        <input type="text" class="form-control" id="name" name="subject">
                    </div>
                    <div class="form-group">
                        <label for="content">{!! trans('tickets.description') !!}</label>
                        <textarea class="form-control" rows="8" id="message" name="content"></textarea>
                    </div>
                    
                    <div class="row mt-10">
                        <div class="form-group col-lg-6">
                            <span for="priority_id">{!! trans('tickets.priority') !!}</span>
                            <select name="priority_id" class="form-control">
                                <option value="">-- {!! trans('tickets.select_one') !!} --</option>
                                @foreach($priorities as $prioritie)
                                    <?php 
                                        $priority_translation = $prioritie->getByLanguageId(1);
                                    ?> 
                                    <option value="{!! $prioritie->id !!}">{!! $priority_translation->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <span for="category_id">{!! trans('tickets.category') !!}</span>
                            <select name="category_id" class="form-control">
                                <option value="">-- {!! trans('tickets.select_one') !!} --</option>
                                @foreach($categories as $categorie)
                                    <?php 
                                        $category_translation = $categorie->getByLanguageId(1);
                                    ?> 
                                    <option value="{!! $categorie->id !!}">{!! $category_translation->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary pull-right">{!! trans('contact.send') !!}</button>
                        </div>
                    </div>
            </form>