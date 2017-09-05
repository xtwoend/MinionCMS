<?php

namespace Minion\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Minion\Entities\Tag;
use Minion\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class TagController extends Controller
{   
    /**
     * [$tags description]
     * @var [type]
     */
    protected $tags;

    /**
     * [__construct description]
     * @param Tag $tags [description]
     */
    public function __construct(Tag $tags)
    {
        $this->tags = $tags;
        config(['site.menu' => 'posts']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tags.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required'
        ]);

        $slug = $request->has('slug')? $request->slug : $request->name;

        $row = $this->tags;
        $row->fill($request->all());
        $row->slug = str_slug($slug);
        $row->save();

        if($request->ajax()){
            return response()->json([
                'success' => true,
                'message' => 'Success saved',
                'data' => $row
            ], 200);
        }
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
        $row = $this->tags->findOrFail($id);
        return view('tags.edit', compact('row'));
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
            'name' => 'required'
        ]);

        $slug = $request->has('slug')? $request->slug : $request->name;

        $row = $this->tags->findOrFail($id);
        $row->fill($request->all());
        $row->slug = str_slug($slug);
        $row->save();

        if($request->ajax()){
            return response()->json([
                'success' => true,
                'message' => 'Success saved',
                'redirect' => route('admin.tags.index')
            ], 200);
        }
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
            $this->tags->whereIn('id', $request->ids)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Category has ben delete!'
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
        $rows = $this->tags->select('*');

        return  Datatables::eloquent($rows)
                ->setRowId('id')
            ->addColumn('mark', function($row){
                return '';
            })
            ->addColumn('action', function($row){
                return '<a href="'.route('admin.tags.edit', $row->id).'">Edit</a>';
            })
            ->make(true);
    }
}
