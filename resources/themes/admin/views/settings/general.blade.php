@extends('layouts.app')

@section('content')
<section class="scrollable wrapper">
    <div class="m-b-md">
        <div class="row">
            <div class="col-md-12">
                <h3 class="m-b-none">Settings</h3>
                <small>Informasi &amp; General Settings</small>
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
                    Informasi Situs
                </header>
                <div class="panel-body">
                    {!! Form::model($row, ['route' => ['admin.settings.store']]) !!}
                    <div class="form-group">
                        <label>Debug</label>
                        {!! Form::select('debug', ['true' => 'TRUE', 'false' => 'FALSE'], null, ['class' => 'input-sm form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label>Site Name</label>
                        {!! Form::text('sitename', null, ['class' => 'input-sm form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label>Tagline</label>
                        {!! Form::textarea('tagline', null, ['class' => 'input-sm form-control', 'rows' => 3]) !!}
                    </div>
                    <div class="form-group">
                        <label>Site Address (URL)</label>
                        {!! Form::text('url', null, ['class' => 'input-sm form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        {!! Form::text('email', null, ['class' => 'input-sm form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label>Language</label>
                        @php
                            $languages = [];
                            foreach(LaravelLocalization::getSupportedLocales() as $lang => $val){
                                $languages[$lang] = $val['native'];
                            }
                        @endphp
                        {!! Form::select('language', $languages, null,['class' => 'input-sm form-control']) !!}
                    </div>

                    <div class="form-group">
                        <label>Timezone</label>
                        {!! Form::text('timezone', null, ['class' => 'input-sm form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label>Storage Driver</label>
                        {!! Form::select('disks', ['local'=> 'Local', 'ftp' => 'FTP', 's3' => 'Amazon S3', 'rackspace' => 'Rackspace'], null, ['class' => 'form-control input-sm']) !!}
                    </div>
                    <div class="form-group">
                        <button class="btn-primary btn btn-sm" data-action="ajax">{{ __('admin::admin.save') }}</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </section>
        </div>
        <div class="col-md-6">
            {{-- DB Setting --}}
            {{-- {{ dd(config('database')) }} --}}
            {{-- <section class="panel panel-default pos-rlt clearfix">
                <header class="panel-heading">
                    <ul class="nav nav-pills pull-right">
                        <li>
                            <a href="#" class="panel-toggle text-muted"><i class="fa fa-caret-down text-active"></i><i class="fa fa-caret-up text"></i></a>
                        </li>
                    </ul>
                    Database
                </header>
                {!! Form::model($row, ['route' => ['admin.settings.store']]) !!}
                <div class="panel-body">
                    <div class="form-group">
                        <label>DB Connection</label>
                        {!! Form::select('db_connection', ['sqlite'=> 'SQLite', 'mysql' => 'MySQL', 'pgsql' => 'PGSQL'], null, ['class' => 'form-control input-sm']) !!}
                    </div>
                    <div class="form-group">
                        <label>DB Host</label>
                        {!! Form::text('db_host', null, ['class' => 'form-control input-sm']) !!}
                    </div> 
                    <div class="form-group">
                        <label>DB Port</label>
                        {!! Form::text('db_port', null, ['class' => 'form-control input-sm']) !!}
                    </div> 
                    <div class="form-group">
                        <label>Database</label>
                        {!! Form::text('db_database', null, ['class' => 'form-control input-sm']) !!}
                    </div> 
                    <div class="form-group">
                        <label>DB Username</label>
                        {!! Form::text('db_username', null, ['class' => 'form-control input-sm']) !!}
                    </div> 
                    <div class="form-group">
                        <label>DB Password</label>
                        <input type="password" name="db_password" value="{{ $row['db_password']??null }}" class="form-control input-sm">
                        {!! Form::password('db_password', ['class' => 'form-control input-sm']) !!}
                    </div> 

                    <button type="submit" class="btn btn-sm btn-primary" data-action="ajax">{{ __('admin::admin.save') }}</button>
                </div>
                {!! Form::close() !!}
            </section> --}}
            {{-- <section class="panel panel-default pos-rlt clearfix">
                <header class="panel-heading">
                    <ul class="nav nav-pills pull-right">
                        <li>
                            <a href="#" class="panel-toggle text-muted"><i class="fa fa-caret-down text-active"></i><i class="fa fa-caret-up text"></i></a>
                        </li>
                    </ul>
                    Email Services
                </header>
                {!! Form::model($row, ['route' => ['admin.settings.store']]) !!}
                <div class="panel-body">
                    <div class="form-group">
                        <label>Mail Driver</label>
                        {!! Form::select('mail_driver', ['smpt' => 'SMTP', 'sendmail' => 'SENDMAIL', 'mailgun' => 'MAILGUN', 'mandrill' => 'MANDRILL'], null, ['class' => 'form-control input-sm']) !!}
                    </div>
                    <div class="form-group">
                        <label>SMTP Host Address</label>
                        {!! Form::text('mail_host', null, ['class' => 'form-control input-sm', 'placeholder' => 'Ketikan hostmail..']) !!}
                    </div> 
                    <div class="form-group">
                        <label>SMTP Host Port</label>
                        {!! Form::text('mail_port', null, ['class' => 'form-control input-sm', 'placeholder' => 'Ketikan port..']) !!}
                    </div> 
                    <div class="form-group">
                        <label>Login Name</label>
                        {!! Form::text('mail_username', null, ['class' => 'form-control input-sm', 'placeholder' => 'Ketikan smtp login..']) !!}
                    </div> 
                    <div class="form-group">
                        <label>Password</label>
                        {!! Form::text('mail_password', null, ['class' => 'form-control input-sm', 'placeholder' => 'Ketikan smtp password..']) !!}
                    </div> 

                    <button type="submit" class="btn btn-sm btn-primary" data-action="ajax">{{ __('admin::admin.save') }}</button>
                </div>
                {!! Form::close() !!}
            </section> --}}
        </div>   
    </div>
    
</section>
@endsection
