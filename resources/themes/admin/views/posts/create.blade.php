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
    .category-wrapper {
        background-color: #fdfdfd;
        padding: 10px;
        border: 1px solid #ddd;
    }

</style>
@endsection

@section('content')

{!! Form::open(['route' => 'admin.posts.store', 'class' => 'full-height']) !!}

<header class="header bg-light lter hidden-print bg-white box-shadow">
    <p> <strong>Tambah Post Baru</strong></p>
    <div class="pull-right toolbar-control" style="margin-top: 10px;">
        <a href="{{ route('admin.posts.index') }}"  class="btn btn-sm btn-info" data-bjax> <i class="fa fa-chevron-left"></i></a>
        <button type="reset" class="btn btn-sm btn-warning">{{ __('admin::admin.reset') }}</button>
        <button class="btn btn-sm btn-success" data-action="ajax"><i class="fa fa-save"></i> {{ __('admin::admin.save') }}</button>
    </div>
</header>

@include('posts._form')

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

    $('a[data-item="add-category"]').on('click', function(e){
        e && e.preventDefault();
        $('.add-category').toggleClass('hide');
    });

    $('button[data-action="add-category"]').on('click', function(e){
        e && e.preventDefault();
        let url = $(this).data('url') || $(this).attr('href');

        $.post(url, {name: $('input[name="category"]').val(), parent_id: $('select[name="cat_parent_id"]').val()}, function(res)
        {
            if(res.success){
                $('.category-wrapper').prepend('<label><input name="post_category[]" type="checkbox" value="' + res.data.id +'" checked=""> '+ res.data.name +'</label> ');
                $('input[name="category"]').val('');
                $('select[name="cat_parent_id"]').val(0);
            }
        });
    });

    $('select[data-item="select2"]').select2({
        tags: true,
        tokenSeparators: [',']
    });
});
</script>
@endsection
