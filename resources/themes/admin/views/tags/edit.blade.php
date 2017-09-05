@extends('layouts.app')

@section('content')

{!! Form::model($row, ['route' => ['admin.tags.update', $row->id], 'class' => 'full-height', 'method' => 'PUT']) !!}

<header class="header bg-light lter hidden-print bg-white box-shadow">
    <p> <strong>{{ __('admin::admin.category') }}</strong></p>
    <div class="pull-right toolbar-control" style="margin-top: 10px;">
        <a href="{{ route('admin.tags.index') }}"  class="btn btn-sm btn-info" data-bjax> <i class="fa fa-chevron-left"></i></a>
        <button type="reset" class="btn btn-sm btn-warning">{{ __('admin::admin.reset') }}</button>
        <button class="btn btn-sm btn-success" data-action="ajax"><i class="fa fa-save"></i> {{ __('admin::admin.save') }}</button>
    </div>
</header>
<section class="hbox stretch">   
    <section class="no-padder b-r">
        <section class="vbox animated fadeInRight">
            <section class="scrollable wrapper hover w-f">
                <h4 class="font-thin">Edit Tag</h4>
                
                <div class="form-group">
                    <label>Name</label>
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <label>Slug</label>
                    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
                </div>
            
                <div class="form-group">
                    <label>Description</label>
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4]) !!}
                </div>

            </section>
        </section>
    </section>
    <section class="no-padder b-r">
        <section class="bg-white-only vbox animated fadeInUp ">
            <section class="scrollable hover wrapper w-f">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </section>
        </section>
    </section>
</section>
{!! Form::close() !!}
@endsection
