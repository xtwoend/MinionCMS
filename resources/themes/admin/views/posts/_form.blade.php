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
                
                <div class="form-group">
                    <div class="checkbox i-checks">
                        <label>
                            {!! Form::checkbox('pinned', 1, null) !!}
                            <i></i>
                            Pinned This post
                        </label>
                    </div>
                </div>

                <div class="line line-dashed b-b line-lg pull-in"></div>
                <h4 class="font-thin">{{ __('admin::admin.categories') }}</h4>
                
                <div class="category-wrapper">
                    @foreach(Minion\Entities\Category::all() as $cat)
                    <label>
                        {!! Form::checkbox('post_category[]', $cat->id, isset($row)? in_array($cat->id, $row->categories()->pluck('categories.id')->toArray()):false) !!} {{  $cat->name }}
                    </label>
                    @endforeach
                </div>
                
                <div class="form-group" style="padding: 10px;">
                    <a href="#" data-item="add-category" style="text-decoration: underline;">+ Add New Category</a>
                </div>

                <div class="add-category hide">
                    
                    <div class="form-group">
                        {!! Form::text('category', null, ['class' => 'form-control input-sm']) !!}
                    </div>
                    @php
                        $options = ['0' => '-- Parent Category --'];
                        $options = nestedSelectNoTrans(Minion\Entities\Category::all(), $options);
                    @endphp
                    <div class="form-group">
                        {!! Form::select('cat_parent_id', $options, null, ['class' => 'form-control input-sm']) !!}
                    </div>
                    <div class="form-group">
                        <button class="btn btn-sm btn-default" data-action="add-category" data-url="{{ route('admin.categories.store') }}">Add New Category</button>    
                    </div>

                </div>

                <div class="line line-dashed b-b line-lg pull-in"></div>

                <h4 class="font-thin">{{ __('admin::admin.tags') }}</h4>
                @php
                    // $optionTags = [];
                    // if(isset($row)){
                    //     foreach($row->tags as $tag){
                    //         $optionTags[$tag->name] = $tag->name; 
                    //     }
                    // }
                @endphp
                <div class="form-group">
                    {{-- {!! Form::select('tags[]', isset($row)? $optionTags : [], isset($row)? $row->tagNames() : null, ['class' => 'form-control', 'data-item' => 'select2', 'multiple' => true]) !!} --}}
                </div>
            </section>
        </section>
    </section>
</section>
