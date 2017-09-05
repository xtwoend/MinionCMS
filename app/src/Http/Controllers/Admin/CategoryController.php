<?php

namespace Minion\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Minion\Entities\Category;
use Minion\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{   
    /**
     * [$categories description]
     * @var [type]
     */
    protected $categories;

    /**
     * [__construct description]
     */
    public function __construct(Category $categories)
    {
        $this->categories = $categories;
        config(['site.menu' => 'posts', 'site.submenu' => 'category']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index');
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

        $row = $this->categories;
        $row->fill($request->all());
        $row->slug = str_slug($slug);
        $row->parent_id = $request->get('parent_id', 0);
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
        $row = $this->categories->findOrFail($id);
        return view('category.edit', compact('row'));
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

        $row = $this->categories->find($id);
        $row->fill($request->all());
        $row->slug = str_slug($slug);
        $row->parent_id = $request->get('parent_id', 0);
        $row->save();

        if($request->ajax()){
            return response()->json([
                'success' => true,
                'message' => 'Success saved',
                'redirect' => route('admin.categories.index')
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
            $this->categories->whereIn('id', $request->ids)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Category has ben delete!'
            ], 200);
        }
    }

    /**
     * [FunctionName description]
     * @param string $value [description]
     */
    public function data(Request $request)
    {   
        $rows = $this->categories->select('*');
        return  Datatables::eloquent($rows)
            ->setRowId('id')
            ->addColumn('mark', function($row){
                return '';
            })
            ->addColumn('count', function($row){
                return $row->posts()->count();
            })
            ->addColumn('action', function($row){
                return '<a href="'.route('admin.categories.edit', $row->id).'">Edit</a>';
            })
            ->make(true);
    }
}
