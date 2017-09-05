@forelse($rows as $row)
<div class="item-list col-xs-6 col-sm-4 col-md-3 col-lg-2" data-id="{{ $row->id }}">
    <div class="item">
        <div class="pos-rlt">
            @if($row->type == 'image')
            <img src="{{ route('image', ['file' => $row->filepath, 'size' => '128x128']) }}" class="img-full">
            @else
            <i class="icon-layers"></i>
            <div class="media-name">{{ $row->name }}</div>
            @endif
        </div>
    </div>
</div>
@empty
no file
@endforelse
{{ $rows->links() }}