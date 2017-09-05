@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ theme_asset('css/dropzone.css') }}">
@endsection

@section('content')
<header class="header bg-light lter hidden-print bg-white box-shadow">
    <p> <strong>Upload Media</strong></p>
    <div class="pull-right toolbar-control" style="margin-top: 10px;">
        <a href="{{ route('admin.media.index') }}" class="btn btn-sm btn-info" data-bjax><i class="fa fa-chevron-left"></i></a>
    </div>
</header>
<section class="hbox stretch">   
    <section class="no-padder b-r">
        <section class="vbox animated fadeInRight">
            <section class="scrollable wrapper hover w-f">
                <div class="media-dropzone">
                    {!! Form::open([ 'route' => [ 'media.upload' ], 'files' => true, 'class' => 'dropzone', 'id' => 'file-upload' ]) !!}

                    {!! Form::close() !!}
                </div>
            </section>
        </section>
    </section>
</section>
@endsection


@section('js')
<script src="{{ theme_asset('js/dropzone.min.js') }}"></script>
@endsection