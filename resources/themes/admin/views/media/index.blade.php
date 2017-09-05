@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ theme_asset('css/dropzone.css') }}">
@endsection

@section('content')
<header class="header bg-light lter hidden-print bg-white box-shadow">
    <p> <strong>Media Library</strong></p>
    <div class="pull-right toolbar-control" style="margin-top: 10px;">
        <a href="{{ route('admin.media.create') }}" class="btn btn-sm btn-info"><i class="icon icon-cloud-upload"></i> Upload Media</a>
    </div>
</header>
<section class="hbox stretch">   
    <section class="no-padder b-r">
        <section class="vbox animated fadeInRight">
            <section class="scrollable hover attachments iscroll wrapper w-f">
                <header class="header hidden-print">
                    <div class="media-toolbar row row-sm" style="padding-top: 10px;">
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
                </header>
                <div class="wrapper">
                    <div class="row row-sm media-items" id="media-items"></div>
                </div>
            </section>
        </section>
    </section>

    <section class="aside-lg bg-white-only no-padder b-r">
        <section class="vbox animated fadeInRight">
            <section class="scrollable wrapper hover w-f">
                <div id="media-info"></div>
            </section>
        </section>
    </section>
</section>

@endsection

@section('modal')
    <script id="media-thumb" type="text/x-handlebars-template">
        @{{#each data}}
        <div class="item-list col-xs-6 col-sm-4 col-md-3 col-lg-2" data-id="@{{ id }}" style="max-width: 168px;">
           <div class="item thumbnail">
                @{{#is type "image"}}
                    <img src="@{{ thumb }}" class="img-responsive">
                @{{else}}
                    <img src="/images/icon/@{{type}}.png" class="img-responsive">
                    <span class="filename">@{{name}}</span>
                @{{/is}}
            </div>
        </div>
        @{{/each}}
    </script>

    <script id="render-item" type="text/x-handlebars-template">
        <div class="item-list col-xs-6 col-sm-4 col-md-3 col-lg-2" data-id="@{{ id }}">
           <div class="item thumbnail">
                @{{#is type "image"}}
                    <img src="@{{ thumb }}" class="img-responsive">
                @{{else}}
                    <img src="/images/icon/@{{type}}.png" class="img-responsive">
                    <span class="filename">@{{name}}</span>
                @{{/is}}
            </div>
        </div>
    </script>
@endsection

@section('js')
<script src="{{ theme_asset('js/dropzone.min.js') }}"></script>
<script src="{{ theme_asset('js/medialib.js') }}"></script>
@endsection