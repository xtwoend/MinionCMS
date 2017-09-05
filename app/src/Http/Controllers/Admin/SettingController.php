<?php

namespace Minion\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Minion\Entities\Setting;
use Minion\Http\Controllers\Controller;

class SettingController extends Controller
{
    protected $settings;

    public function __construct(Setting $settings)
    {
        config(['site.menu' => 'setting']);
        $this->settings = $settings;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $row = $this->settings->pluck('value', 'key');
        return view('settings.general', compact('row'));
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
        Cache::forget('config');

        $request = $request->except('_token');
        foreach ($request as $key => $value) {
            $row = $this->settings->firstOrCreate(['key' => $key]);
            $row->value = $value;
            $row->save();
        }

        Cache::forever('config', $this->settings->pluck('value', 'key')->toArray());

        return response()->json([
            'success' => true,
            'message' => 'Setting has been update'
        ], 200);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * [theme description]
     * @return [type] [description]
     */
    public function theme()
    {
        # code...
    }
}
