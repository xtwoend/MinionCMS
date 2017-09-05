<?php

namespace Minion\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Minion\Entities\Post;
use Minion\Http\Controllers\Admin\Controller;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{
    /**
     * [$posts description]
     * @var [type]
     */
    protected $posts;

    /**
     * [__construct description]
     * @param Post $posts [description]
     */
    public function __construct(Post $posts)
    {
        $this->posts = $posts;
        config(['site.menu' => 'posts']);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return theme('posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return theme('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->validate($request, [
            'title' => 'required',
            'slug'  => 'required',
            'content'  => 'required',
        ]);

        $row = $this->posts;
        $row->fill($request->all());
        $row->type = 'post';
        $row->publish = $request->get('publish', 0);
        $row->comment_status = $request->get('comment_status', 0);
        $row->author = Auth::id();
        $row->save();

        // save categories
        if($request->has('post_category')){
            $row->categories()->sync($request->get('post_category',[]));
        }

        // save tags
        if($request->has('tags')){
            // $row->retag($request->tags);
        }
        
        if($request->ajax()){
            return response()->json([
                'success' => true,
                'message' => 'Success saved.',
                'redirect' => route('admin.posts.index')
            ], 200);
        }
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = $this->posts->findOrFail($id);
        return theme('posts.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $this->validate($request, [
            'title' => 'required',
            'slug'  => 'required',
            'content'  => 'required',
        ]);

        $row = $this->posts->find($id);
        $row->fill($request->all());
        $row->type = 'post';
        $row->publish = $request->get('publish', 0);
        $row->comment_status = $request->get('comment_status', 0);
        $row->author = Auth::id();
        $row->save();

        // save categories
        if($request->has('post_category')){
            $row->categories()->sync($request->get('post_category',[]));
        }

        // save tags
        if($request->has('tags')){
            // $row->retag($request->tags);
        }

        if($request->ajax()){
            return response()->json([
                'success' => true,
                'message' => 'Success saved.',
                'redirect' => route('admin.posts.index')
            ], 200);
        }
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if($request->ajax()){
            $this->posts->whereIn('id', $request->ids)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Post has ben delete!'
            ], 200);
        }
    }

    /**
     * [data description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function data(Request $request)
    {   
        $rows = $this->posts->type('post')->with('user')->select('posts.*');

        return  Datatables::eloquent($rows)
                ->setRowId('id')
                ->addColumn('mark', function($row){
                    return '';
                })
                ->addColumn('categories', function($row){
                    $categories = $row->categories()->pluck('name')->toArray();
                    return implode(', ', $categories);
                })
                ->addColumn('action', function($row){
                    return '<a href="'.route('admin.posts.edit', $row->id).'" data-bjax><i class="icon icon-pencil"></i> Edit</a>';
                })
                ->make(true);
    }

}
