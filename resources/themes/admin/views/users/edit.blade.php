@extends('layouts.app')

@section('content')

{!! Form::model($row, ['route' => ['admin.users.update', $row->id], 'class' => 'full-height', 'method' => 'PUT']) !!}

<header class="header bg-light lter hidden-print bg-white box-shadow">
    <p> <strong>{{ __('admin::admin.category') }}</strong></p>
    <div class="pull-right toolbar-control" style="margin-top: 10px;">
        <a href="{{ route('admin.users.index') }}"  class="btn btn-sm btn-info" data-bjax> <i class="fa fa-chevron-left"></i></a>
        <button type="reset" class="btn btn-sm btn-warning">{{ __('admin::admin.reset') }}</button>
        <button class="btn btn-sm btn-success" data-action="ajax"><i class="fa fa-save"></i> {{ __('admin::admin.save') }}</button>
    </div>
</header>
<section class="hbox stretch">   
    <section class="no-padder b-r">
        <section class="vbox animated fadeInRight">
            <section class="scrollable wrapper hover w-f">
                <h4 class="font-thin">Edit User</h4>
                
                <div class="form-group">
                    <label>Name</label>
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <label>Email</label>
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <label>Retype Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <div class="form-group">
                    <div class="checkbox i-checks">
                        <label>
                            {!! Form::checkbox('is_admin', 1, null) !!}
                            <i></i>
                            Is Super Admin
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="checkbox i-checks">
                        <label>
                            {!! Form::checkbox('status', 1, null) !!}
                            <i></i>
                            Active
                        </label>
                    </div>
                </div>

            </section>
        </section>
    </section>
    <section class="no-padder b-r">
        <section class="bg-white-only vbox animated fadeInUp ">
            <section class="scrollable hover wrapper w-f">
                <h4 class="font-thin">Assign Roles</h4>

                @foreach(Minion\Entities\Role::all() as $role)
                <div class="form-group">
                    <div class="checkbox i-checks">
                        <label>
                            {!! Form::checkbox('roles[]', $role->id, in_array($role->id, $row->roles()->pluck('id')->toArray())) !!}
                            <i></i>
                            {{ $role->name }}
                        </label>
                    </div>
                </div>
                @endforeach

            </section>
        </section>
    </section>
</section>
{!! Form::close() !!}
@endsection
