<section class="hbox stretch">   
    <section class="no-padder b-r">
        <section class="vbox animated fadeInUp ">
            <section class="scrollable hover wrapper w-f">
                
                <div class="form-group">
                    {!! Form::text("title", null, ['class' => 'form-control input-lg', 'placeholder' => 'Masukan judul disini', 'data-item' => 'title']) !!}
                </div>

                <div class="form-group">
                    <div class="input-group slug">
                        <span class="input-group-addon bg-white-only">{{ url('/') }}/</span>
                        {!! Form::text("slug", null, ['class' => 'form-control title-slug', 'data-item'=> 'slug']) !!}
                    </div>
                </div>

                <button class="btn btn-default" data-item="media-manager"><i class="icon-picture icon"></i> Add Media</button>

                <div class="form-group m-t">
                    {{-- <codemirror v-model="code"></codemirror> --}}
                    {!! Form::textarea("content", null, ['class' => 'form-control', 'data-item' => 'editor', 'data-url' => route('media.upload')]) !!}
                </div>

            </section>
        </section>
    </section>
    <section class="aside-lg bg-white-only no-padder b-r">
        <section class="vbox animated fadeInRight">
            <section class="scrollable wrapper hover w-f">

                {{-- <h4 class="font-thin">Featured Image</h4>
                <div class="image">
                    <a href="#" data-item="media-manager" style="margin: 20px 0;">Set featured image</a>
                </div>
                <div class="line line-dashed b-b line-lg pull-in"></div> --}}
                
                <h4 class="font-thin">Publish</h4>

                <div class="form-group">
                    <div class="checkbox i-checks">
                        <label>
                            {!! Form::checkbox('publish', 1, null) !!}
                            <i></i>
                            Publish
                        </label>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Publish immediately</label>
                    {!! Form::text('published_at', date('Y-m-d H:i:s'), ['class' => 'form-control input-sm datetime']) !!}
                </div>
                
                <div class="form-group">
                    <div class="checkbox i-checks">
                        <label>
                            {!! Form::checkbox('comment_status', 1, null) !!}
                            <i></i>
                            Allow Comments
                        </label>
                    </div>
                </div>
                
                <h4 class="font-thin">Page Attributes</h4>
                <div class="form-group">
                    <label>Parent</label>
                    @php
                        $options = [ NULL => '(no parent)'];
                        $options = nestedSelect(pages()->menus()->get(), $options);
                    @endphp
                    {!! Form::select('parent_id', $options, null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label>Order</label>
                    {!! Form::text('order', null, ['class' => 'form-control']) !!}
                </div>
            </section>
        </section>
    </section>
</section>
