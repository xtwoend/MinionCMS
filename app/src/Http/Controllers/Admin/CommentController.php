<?php

namespace Minion\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Minion\Entities\Comment;
use Minion\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class CommentController extends Controller
{   
    /**
     * [$comments description]
     * @var [type]
     */
    protected $comments;

    /**
     * [__construct description]
     * @param Comment $comments [description]
     */
    public function __construct(Comment $comments)
    {
        $this->comments = $comments;
        config(['site.menu' => 'comments']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('comments.index');
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
            'content' => 'required'
        ]);

        $row = $this->comments;
        $row->fill($request->all());
        $row->save();

        if($request->ajax()){
            return response()->json([
                'success' => true,
                'message' => 'Success saved',
                'redirect' => route('admin.comments.index')
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
        $row = $this->comments->findOrFail($id);
        return view('comments.edit', compact('row'));
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
            'content' => 'required'
        ]);

        $row = $this->comments->find($id);
        $row->fill($request->all());
        $row->save();

        if($request->ajax()){
            return response()->json([
                'success' => true,
                'message' => 'Success saved',
                'redirect' => route('admin.comments.index')
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
            $this->comments->whereIn('id', $request->ids)->delete();
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
        $rows = $this->comments->with('post')->select('*');
        return  Datatables::eloquent($rows)
            ->setRowId('id')
            ->addColumn('mark', function($row){
                return '';
            })
            ->editColumn('approved', function($row){
                return ($row->approved)? 'yes' : 'no';
            })
            ->addColumn('action', function($row){
                $btn  = '<a href="'.route('admin.comments.approved', $row->id).'" class="link" data-action="publish">'.(($row->approved)? 'Unpublish':'Publish' ).'</a>|';
                $btn .= '<a href="'.route('admin.comments.reply', $row->id).'" class="link">Reply</a>|';
                $btn .= '<a href="'.route('admin.comments.edit', $row->id).'" class="link">Edit</a>';
                return $btn;
            })
            ->make(true);
    }

    /**
     * [reply description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function reply($id)
    {
        $row = $this->comments->findOrFail($id);
        return view('comments.reply', compact('row'));
    }

    /**
     * [replySubmit description]
     * @param  [type]  $id      [description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function approved($id, Request $request)
    {
        $row = $this->comments->find($id);
        $row->approved = ($row->approved)? 0: 1;
        $row->save();

        if($request->ajax()){
            return response()->json([
                'success' => true,
                'data' => ($row->approved) ? 'Publish': 'Unpublish'
            ], 200);
        }
    }


}
