<?php

namespace Minion\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Minion\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    /**
     * [$permissions description]
     * @var [type]
     */
    protected $permissions;

    /**
     * [__construct description]
     * @param User $permissions [description]
     */
    public function __construct(Permission $permissions)
    {
        config(['site.menu' => 'users']);
        $this->permissions = $permissions;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
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
            'name' => 'required|max:255',
        ]);

        $row = $this->permissions;
        $row->fill($request->all());
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
        $row = $this->permissions->findOrFail($id);
        return view('permissions.edit', compact('row'));
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
            'name' => 'required|max:255',
        ]);

        $row = $this->permissions->find($id);
        $row->fill($request->only('name'));
        $row->save();

        if($request->ajax()){
            return response()->json([
                'success' => true,
                'message' => 'Success saved',
                'redirect' => route('admin.permissions.index')
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
            $this->permissions->whereIn('id', $request->ids)->delete();
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
        $rows = $this->permissions->select('*');

        return  Datatables::eloquent($rows)
            ->setRowId('id')
            ->addColumn('mark', function($row){
                return '';
            })
            ->addColumn('action', function($row){
                return '<a href="'.route('admin.permissions.edit', $row->id).'">Edit</a>';
            })
            ->make(true);
    }
}
