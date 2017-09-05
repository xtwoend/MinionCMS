@extends('layouts.app')

@section('content')
<section class="scrollable wrapper">
    <div class="m-b-md">
        <div class="row">
            <div class="col-md-12">
                <h3 class="m-b-none">Dashbord</h3>
                <small>Informasi &amp; Statistic website</small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <section class="panel panel-default pos-rlt clearfix">
                <header class="panel-heading">
                    <ul class="nav nav-pills pull-right">
                        <li>
                            <a href="#" class="panel-toggle text-muted"><i class="fa fa-caret-down text-active"></i><i class="fa fa-caret-up text"></i></a>
                        </li>
                    </ul>
                    Selayang Pandang
                </header>
                <div class="panel-body list-group no-radius alt no-padder">
                    <a class="list-group-item" href="{{ route('admin.posts.index') }}">
                        <span class="badge bg-success">{{ posts()->count() }}</span>
                        <i class="icon-note icon icon-muted"></i> 
                        Posts
                    </a>
                    <a class="list-group-item" href="{{ route('admin.comments.index') }}">
                        <span class="badge bg-info">{{ comments()->count() }}</span>
                        <i class="icon-speech icon icon-muted"></i> 
                        Comments
                    </a>
                    <a class="list-group-item" href="{{ route('admin.pages.index') }}">
                        <span class="badge bg-light">{{ pages()->count() }}</span>
                        <i class="icon-docs icon icon-muted"></i> 
                        Pages
                    </a>
                </div>
            </section>

            <section class="panel panel-default pos-rlt clearfix">
                <header class="panel-heading">
                    <ul class="nav nav-pills pull-right">
                        <li>
                            <a href="#" class="panel-toggle text-muted"><i class="fa fa-caret-down text-active"></i><i class="fa fa-caret-up text"></i></a>
                        </li>
                    </ul>
                    Aktivitas
                </header>
                <div class="panel-body list-group no-radius alt no-padder">
                    <div class="wrapper">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. 
                    </div>
                    <div class="list-group-item">
                        <span class="text-muted small">Mar 31st, 10:37 am </span>
                    </div>
                    <div class="list-group-item">
                        Komentar Terbaru
                    </div>
                </div>
            </section>

        </div>
        <div class="col-md-6">
            <section class="panel panel-default pos-rlt clearfix">
                <header class="panel-heading">
                    <ul class="nav nav-pills pull-right">
                        <li>
                            <a href="#" class="panel-toggle text-muted"><i class="fa fa-caret-down text-active"></i><i class="fa fa-caret-up text"></i></a>
                        </li>
                    </ul>
                    Draf Cepat
                </header>
                {!! Form::open(['route' => 'admin.posts.store']) !!}
                <div class="panel-body">
                    <div class="form-group">
                        <label>Title</label>
                        {!! Form::text('lang['.app()->getLocale().'][title]', null, ['class' => 'form-control input-sm', 'placeholder' => 'Ketikan judul..']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('lang['.app()->getLocale().'][slug]', null, ['class' => 'form-control input-sm', 'placeholder' => 'Ketikan slug..']) !!}
                    </div>  
                    <div class="form-group">
                        {!! Form::textarea('lang['.app()->getLocale().'][content]', null, ['class' => 'form-control input-sm', 'placeholder' => 'Ada berita apa sekarang?']) !!}
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary" data-action="ajax">Simpan Konsep</button>
                </div>
                {!! Form::close() !!}
            </section>
        </div>   
    </div>
    
</section>
@endsection
