@extends('layouts.app')

@section('content')

{!! Form::open(['route' => ['admin.comments.store'], 'class' => 'full-height']) !!}
{!! Form::hidden('parent_id', $row->id) !!}
{!! Form::hidden('post_id', $row->post_id) !!}

<header class="header bg-light lter hidden-print bg-white box-shadow">
    <p> <strong>{{ __('admin::admin.comments') }}</strong></p>
    <div class="pull-right toolbar-control" style="margin-top: 10px;">
        <a href="{{ route('admin.comments.index') }}"  class="btn btn-sm btn-info" data-bjax> <i class="fa fa-chevron-left"></i></a>
        <button type="reset" class="btn btn-sm btn-warning">{{ __('admin::admin.reset') }}</button>
        <button class="btn btn-sm btn-success" data-action="ajax"><i class="fa fa-save"></i> {{ __('admin::admin.save') }}</button>
    </div>
</header>
<section class="hbox stretch">   
    <section class="no-padder b-r">
        <section class="vbox animated fadeInRight">
            <section class="scrollable wrapper hover w-f">
                <h4 class="font-thin">Reply Comment</h4>
                
                <div class="form-group">
                    <label>Name</label>
                    {!! Form::text('comment_author', Auth::user()->name, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <label>Email</label>
                    {!! Form::text('comment_email', Auth::user()->email, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <label>Site</label>
                    {!! Form::text('comment_website', url('/'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <label>Comment</label>
                    {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 4]) !!}
                </div>

            </section>
        </section>
    </section>
    <section class="no-padder b-r">
        <section class="bg-white-only vbox animated fadeInUp ">
            <section class="scrollable hover wrapper w-f">
                {{ $row->content }}
            </section>
        </section>
    </section>
</section>
{!! Form::close() !!}
@endsection
