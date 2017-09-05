<?php

namespace Minion\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Minion\Entities\Post;
use Minion\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class PageController extends Controller
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
        config(['site.menu' => 'pages']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return theme('pages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return theme('pages.create');
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
        $row->type = 'page';
        $row->publish = $request->get('publish', 0);
        $row->order = $request->get('order', 0);
        $row->author = Auth::id();
        $row->save();

        if($request->ajax()){
            return response()->json([
                'success' => true,
                'message' => 'Success saved.',
                'redirect' => route('admin.pages.index')
            ], 200);
        }

        return redirect()->route('admin.pages.index');
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
        return theme('pages.edit', compact('row'));
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
        $row->type = 'page';
        $row->publish = $request->get('publish', 0);
        $row->order = $request->get('order', 0);
        $row->author = Auth::id();
        $row->save();
        if($request->ajax()){
            return response()->json([
                'success' => true,
                'message' => 'Success saved.',
                'redirect' => route('admin.pages.index')
            ], 200);
        }
        return redirect()->route('admin.pages.index');
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
        $rows = $this->posts->type('page')->with('user')->select('posts.*');

        return  Datatables::eloquent($rows)
                ->setRowId('id')
                ->addColumn('mark', function($row){
                    return '';
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('admin.pages.edit', $row->id).'" data-bjax><i class="icon icon-pencil"></i> Edit</a>';
                    return $btn;
                })
                ->make(true);
    }
}
