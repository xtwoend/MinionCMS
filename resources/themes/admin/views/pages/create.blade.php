@extends('layouts.app')

@section('css')
{{-- media css --}}
<link rel="stylesheet" type="text/css" href="{{ theme_asset('css/dropzone.css') }}">
<link rel="stylesheet" type="text/css" href="{{ theme_asset('css/remodal.css') }}">
<link rel="stylesheet" type="text/css" href="{{ theme_asset('css/remodal-default-theme.css') }}">
{{-- end media css --}}
<style type="text/css">
    .slug > span {
        padding-right: 0px;
        border-right: 0px solid #fff;
    }
    .slug > .title-slug {
        padding-left: 0px;
        border-left: 0px solid #fff;
    }
    .mce-btn-group:last-child {
        float: right;
    }
</style>
@endsection

@section('content')

{!! Form::open(['route' => 'admin.pages.store', 'class' => 'full-height']) !!}

<header class="header bg-light lter hidden-print bg-white box-shadow">
    <p> <strong>Tambah Laman Baru</strong></p>
    <div class="pull-right toolbar-control" style="margin-top: 10px;">
        <a href="{{ route('admin.pages.index') }}"  class="btn btn-sm btn-info" data-bjax> <i class="fa fa-chevron-left"></i></a>
        <button type="reset" class="btn btn-sm btn-warning">{{ __('admin::admin.reset') }}</button>
        <button class="btn btn-sm btn-success" data-action="ajax"><i class="fa fa-save"></i> {{ __('admin::admin.save') }}</button>
    </div>
</header>

@include('pages._form')

{!! Form::close() !!}
@endsection

@section('modal')
    @include('media.modal')
@endsection

@section('js')

{{-- media js --}}
<script src="{{ theme_asset('js/dropzone.min.js') }}"></script>
<script src="{{ theme_asset('js/remodal.js') }}"></script>
<script src="{{ theme_asset('js/media.js') }}"></script>
{{-- end media js --}}

<script>
$(function (){
    $('input[data-item="title"]').slugIt({output: 'input[data-item="slug"]'});
});
</script>
@endsection
