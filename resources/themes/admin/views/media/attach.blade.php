<h4 class="font-thin">Attachment Details @if($row->type === 'xxx')<a href="{{ route('media.imgedit', $row->id) }}" class="btn btn-xs btn-primary" data-action="edit-img">Edit</a>@endif</h4>
@if($row->type == 'image')
<img src="{{ $row->thumb }}" class="img-responsive img-thumb">
@else
<img src="/images/icon/{{$row->type}}.png" class="img-responsive img-thumb">
@endif
<span class="text-muted">Size: {{ formatBytes($row->filesize) }}</span>

<div class="form-group">
    <label>URL</label>
    {!! Form::text('url', $row->url, ['class' => 'form-control', 'readonly' => true]) !!}
</div>
<div class="form-group">
    <label>Name</label>
    {!! Form::text('name', $row->name, ['class' => 'form-control']) !!}
</div> 
<div class="form-group">
    <label>Caption</label>
    {!! Form::textarea('description', $row->description, ['class' => 'form-control', 'rows' => 2]) !!}
</div> 

<a href="{{ route('admin.media.delete', $row->id) }}" class="text-danger" data-action="delete-file">Delete file permanent</a>