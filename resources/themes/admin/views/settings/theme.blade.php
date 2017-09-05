@extends('layouts.app')

@section('content')
<section class="scrollable wrapper">
    <div class="m-b-md">
        <div class="row">
            <div class="col-md-12">
                <h3 class="m-b-none">Themes</h3>
                <small>Styles &amp; Simple Themes</small>
            </div>
        </div>

        <div class="row media-items">
            @foreach($themes as $theme)
            <div class="item-list col-xs-6 col-sm-4 col-md-3 col-lg-2">
                <div class="item thumbnail">
                    <div class="pos-rlt">
                        <img src="{{ route('theme.thumb', $theme->name) }}" class="img-full">
                        <div class="media-name">{{ $theme->name }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection