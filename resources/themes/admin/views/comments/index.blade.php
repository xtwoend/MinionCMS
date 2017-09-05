@extends('layouts.app')

@section('content')
<header class="header bg-light lter hidden-print bg-white box-shadow">
    <p> <strong>{{ __('admin::admin.comments') }}</strong></p>
    <div class="pull-right toolbar-control" style="margin-top: 10px;">
        <button data-action="refresh" class="btn btn-sm btn-info"><i class="icon icon-refresh"></i> {{ __('admin::admin.refresh') }}</button>
        <button data-action="delete" class="btn btn-sm btn-danger" data-url="{{ route('admin.comments.destroy', 0) }}"><i class="icon icon-trash"></i> {{ __('admin::admin.delete') }}</button>
    </div>
</header>

<section class="hbox stretch">   
    <section class="no-padder b-r">
        <section class="vbox animated fadeInUp ">
            <section class="scrollable hover wrapper w-f">
                <section class="panel panel-default box-shadow">

                    <div class="table-responsive">
                        <table class="table table-striped m-b-none" data-ride="datatables" id="comments-table">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="checkbox i-checks">
                                            <label><input type="checkbox" data-item="check-all"><i></i></label>
                                        </div>
                                    </th>
                                    <th class="col-sm-2">Author</th>
                                    <th class="col-sm-4">Comments</th>
                                    <th class="col-sm-3">In Response To</th>
                                    <th class="col-sm-2">Submitted On</th>
                                    <th class="option"></th>
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
   var locale = '{{ App::getLocale() }}';
    var tbl = $('#comments-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{!! route('admin.comments.data') !!}',
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
            { data: 'comment_author', name: 'comment_author' },
            { data: 'content', name: 'content' },
            { data: 'post.title.' + locale, name: 'post.title', orderable: true, searchable: true, },
            { data: 'created_at', name: 'created_at' },
            { data: 'approved', name: 'approved' },
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
                            text: "Your comments has been deleted",
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
        $('#comments-table_filter input').val(this.value);
        $('#comments-table_filter input').trigger(e.type, {'e': press});        
    });

    $(document).on('click', 'a[data-action="publish"]', function(e){
        e && e.preventDefault();

        let url = $(this).attr('href');
        setTimeout(function(){
            $.post(url, {_method: 'POST'}, function(res){
                swal({
                        title: res.data + "!!",
                        text: "Your comments has been " + res.data,
                        type: "success",
                        timer: 1000,   
                        showConfirmButton: false 
                });
                tbl.ajax.reload(null, false); 
            });
        }, 300); 

    });
});
</script>
@endsection