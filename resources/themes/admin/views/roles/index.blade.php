@extends('layouts.app')

@section('content')
<header class="header bg-light lter hidden-print bg-white box-shadow">
    <p> <strong>{{ __('admin::admin.roles') }}</strong></p>
    <div class="pull-right toolbar-control" style="margin-top: 10px;">
        <button data-action="refresh" class="btn btn-sm btn-info"><i class="icon icon-refresh"></i> {{ __('admin::admin.refresh') }}</button>
        <button data-action="delete" class="btn btn-sm btn-danger" data-url="{{ route('admin.roles.destroy', 0) }}"><i class="icon icon-trash"></i> {{ __('admin::admin.delete') }}</button>
    </div>
</header>
<section class="hbox stretch">   
    <section class="no-padder b-r" style="width: 400px; max-width: 400px;">
        <section class="vbox animated fadeInRight">
            <section class="scrollable wrapper hover w-f">
                <h4 class="font-thin">Add New Role</h4>
                
                {!! Form::open(['route' => 'admin.roles.store', 'class' => 'normal']) !!}

                <div class="form-group">
                    <label>Name</label>
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                
                <button type="submit" class="btn btn-primary" data-action="ajax">Add New Role</button>

                {!! Form::close() !!}
            </section>
        </section>
    </section>
    <section class="no-padder b-r">
        <section class="vbox animated fadeInUp ">
            <section class="scrollable hover wrapper w-f">
                <section class="panel panel-default box-shadow">
                    <div class="table-responsive">
                        <table class="table table-striped m-b-none" data-ride="datatables" id="roles-table">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="checkbox i-checks">
                                            <label><input type="checkbox" data-item="check-all"><i></i></label>
                                        </div>
                                    </th>
                                    <th class="col-sm-11">Name</th>
                                    <th class="option"></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </section>
            </section>
        </section>
    </section>
</section>
@endsection

@section('js')
<script>
$(function(){
    var tbl = $('#roles-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{!! route('admin.roles.data') !!}',
            type: "POST"
        },
        language: { search: "", sLengthMenu: "_MENU_"},
        sDom: "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        columns: [
            { data: 'mark', name: 'mark', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'action', name: 'action', orderable: false, searchable: false, className: 'option' }
        ],
        order: [[ 1, 'asc' ]]
    });

    $('input[data-item="check-all"]').change(function() {
        if(this.checked) {
            tbl.rows().select();
        }else{
            tbl.rows().deselect();
        }
    });

    $('button[data-action="refresh"]').on('click', function(e){
        e && e.preventDefault();
        tbl.ajax.reload(null, false);
    });

    $('button[data-action="delete"]').on('click', function(e){
        e.preventDefault();
        var url = $(this).data('url') || $(this).attr('href');
        var arrData = [];

        $.each(tbl.rows('.selected').data(), function(index, el) {
            arrData.push(el.id);
        });

        if(arrData.length === 0){
            swal("Oops...", "Please select first.." , "error");
            return;
        }

        swal({   
            title: "Are you sure?",   
            text: "You will not be able to recover this data!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, delete it!",   
            closeOnConfirm: false ,
            showLoaderOnConfirm: true,
        }, function(){  
            setTimeout(function(){
                $.post(url, {ids: arrData, _method: 'DELETE'}, function(res){
                    swal({
                            title: "Deleted!!",
                            text: "Your post has been deleted",
                            type: "success",
                            timer: 1000,   
                            showConfirmButton: false 
                    });
                    tbl.ajax.reload(null, false); 
                });
            }, 1000);   
        });
    });

    $('input[data-item="search"]').on('keypress keyup keydown', function(e) { 
        var press   = jQuery.Event(e.type),
            code    = e.keyCode || e.which,
            forget  = [9, 16, 17, 18, 224],
            owner   = this;
        press.which = code ;
        if( $.inArray(press.which, forget) > 0 ) return;
        $('#roles-table_filter input').val(this.value);
        $('#roles-table_filter input').trigger(e.type, {'e': press});        
    });
});
</script>
@endsection