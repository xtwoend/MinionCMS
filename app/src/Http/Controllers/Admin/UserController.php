<?php

namespace Minion\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Minion\Entities\User;
use Minion\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * [$users description]
     * @var [type]
     */
    protected $users;

    /**
     * [__construct description]
     * @param User $users [description]
     */
    public function __construct(User $users)
    {
        config(['site.menu' => 'users']);
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $row = $this->users;
        $row->fill($request->all());
        $row->is_admin = $request->get('is_admin', 0);
        $row->status = $request->get('status', 0);
        $row->password = bcrypt($request->password);
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
        $row = $this->users->findOrFail($id);
        return view('users.edit', compact('row'));
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
            'email' => 'email|max:255',
            'password' => 'confirmed',
        ]);

        $row = $this->users->find($id);
        $row->fill($request->only('name', 'email'));
        $row->is_admin = $request->get('is_admin', 0);
        $row->status = $request->get('status', 0);

        if($request->has('password') && ! is_null($request->password)){
            $row->password = bcrypt($request->password);
        }

        // roles
        if($request->has('roles') && is_array($request->roles) && count($request->roles) > 0){
            $row->roles()->sync($request->roles);
        }else {
            $row->detach();
        }

        $row->save();

        if($request->ajax()){
            return response()->json([
                'success' => true,
                'message' => 'Success saved',
                'redirect' => route('admin.users.index')
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
            $this->users->whereIn('id', $request->ids)->delete();
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
        $rows = $this->users->select('*');

        return  Datatables::eloquent($rows)
            ->setRowId('id')
            ->addColumn('mark', function($row){
                return '';
            })
            ->editColumn('is_admin', function($row){
                return ($row->is_admin)? 'Yes': 'No';
            })
            ->editColumn('status', function($row){
                return ($row->status)? 'Active' : 'Non Active';
            })
            ->addColumn('roles', function($row){
                return implode(', ', $row->roles()->pluck('name')->toArray());
            })
            ->addColumn('action', function($row){
                return '<a href="'.route('admin.users.edit', $row->id).'">Edit</a>';
            })
            ->make(true);
    }
}
