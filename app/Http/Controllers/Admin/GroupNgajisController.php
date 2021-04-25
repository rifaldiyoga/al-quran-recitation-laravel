<?php

namespace App\Http\Controllers\Admin;

use App\GroupNgaji;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GroupNgajisRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class GroupNgajisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = GroupNgaji::all();

        return view('pages.admin.group-ngaji.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.admin.group-ngaji.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupNgajisRequest $request)
    {
        $data = $request->all();
        $data['img_src'] = $request->file('img_src')->store(
            'assets/grup_photo', 'public'
        );
        $data['created_by'] = Auth::user()->id;
        $data['slug'] = Str::slug($request->group_name);

        GroupNgaji::create($data);
        return redirect()->route('group-ngaji.index');
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
        $item = GroupNgaji::findOrFail($id);
        $item->delete();

        return redirect()->route('group-ngaji.index');
    }
}
