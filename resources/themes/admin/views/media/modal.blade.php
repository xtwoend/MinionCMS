<div class="remodal hbox stretch no-padder" data-remodal-id="media">
    <button data-remodal-action="close" class="remodal-close"></button>
    <aside class="aside media-menu b-r">
        {{-- <ul class="list-group no-radius m-t">
            <li class="list-group-item no-border"><a href="#">Insert Media</a></li>
            <li class="list-group-item no-border"><a href="#">Create Gallery</a></li>
            <li class="list-group-item no-border"><a href="#">Featured Image</a></li>
        </ul> --}}
    </aside>
    <section class="media-content">
        <div class="media-header">
            <h4 class="font-thin">Media Manager</h4>
        </div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation">
                <a href="#upload" aria-controls="upload" role="tab" data-toggle="tab">Upload Files</a>
            </li>
            <li role="presentation"  class="active">
                <a href="#library" aria-controls="library" role="tab" data-toggle="tab">Media Library</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <section role="tabpanel" class="tab-pane wrapper" id="upload">
                <div class="media-dropzone">
                    {!! Form::open([ 'route' => [ 'media.upload' ], 'files' => true, 'class' => 'dropzone', 'id' => 'file-upload' ]) !!}

                    {!! Form::close() !!}
                </div>
            </section>
            <section role="tabpanel" class="tab-pane active media-content-tab" id="library">
                <div class="media-library">
                    <div class="media-toolbar row row-sm">
                        <div class="col-md-4">
                            {!! Form::select('type', [
                                'all'   => 'All media items',
                                'image' => 'Images', 
                                'video' => 'Video',
                                'audio' => 'Audio',
                                'zip'   => 'Zip/RAR',
                                'file'  => 'Others'
                            ], null, ['class' => 'form-control input-sm', 'data-item' => 'media-type']) !!}
                        </div> 
                        <div class="col-md-4">
                            @php
                                $dateOption = ['all' => 'All dates'];
                                $dateOption = array_merge($dateOption, Minion\Entities\Media::select(DB::raw("DATE_FORMAT(created_at, '%M %Y') as date_at"))->groupBy('date_at')->orderBy('date_at')->pluck('date_at', 'date_at')->toArray());
                            @endphp
                            {!! Form::select('created_at', $dateOption, null, ['class' => 'form-control input-sm', 'data-item' => 'media-time']) !!}
                        </div> 
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control input-sm" data-item="search">
                        </div> 
                    </div>
                    <div class="attachments iscroll hover wrapper">
                        <div class="row row-sm" id="media-items">
                        </div>
                    </div>
                    <div class="media-sidebar hover">
                        <div id="media-info"></div>
                    </div>
                </div>
            </section>
        </div> 
        <footer class="media-footer">
            <span class="item-selected"></span>
            <button class="btn btn-sm btn-primary pull-right" data-item="insert-media">Insert into page</button>
        </footer>
    </section>
</div>

{{-- script js tempate engine --}}
<script id="media-thumb" type="text/x-handlebars-template">
    @{{#each data}}
    <div class="item-list col-xs-6 col-sm-4 col-md-3 col-lg-2" data-id="@{{ id }}">
       <div class="item">
            <div class="pos-rlt">
                @{{#is type "image"}}
                    <img src="@{{ thumb }}" class="img-full">
                @{{else}}
                    <img src="/images/icon/@{{type}}.png" class="img-full">
                    <span class="filename">@{{name}}</span>
                @{{/is}}
            </div>
        </div>
    </div>
    @{{/each}}
</script>

<script id="render-item" type="text/x-handlebars-template">
    <div class="item-list col-xs-6 col-sm-4 col-md-3 col-lg-2" data-id="@{{ id }}">
       <div class="item">
            <div class="pos-rlt">
                @{{#is type "image"}}
                    <img src="@{{ thumb }}" class="img-full">
                @{{else}}
                    <img src="/images/icon/@{{type}}.png" class="img-full">
                    <span class="filename">@{{name}}</span>
                @{{/is}}
            </div>
        </div>
    </div>
</script>