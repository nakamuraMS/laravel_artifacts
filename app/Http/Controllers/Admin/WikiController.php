<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Wiki;

class WikiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Wiki::query()->select())
            ->addIndexColumn()
            ->addColumn('edit', function($row){
                $url = route('admin.wiki.edit', ['wiki_id' => $row->id]);
                $btn = '<a class="btn btn-success btn-block" href="' . $url . '" role="button">編集</a>';
                return $btn;
            })
            ->editColumn('disp', function($row){
                $disp = ($row->disp === \App\Models\Wiki::DISP_ON ? '公開' : ($row->disp === \App\Models\Wiki::DISP_OFF ? '非公開' : ''));
                return $disp;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('admin.wiki.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.wiki.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $wiki         = new Wiki();
            $wiki->title  = $request->title;
            $wiki->body   = $request->body;
            $wiki->disp   = $request->disp;
            $wiki->save();

            DB::commit();
            Session::flash('message', '新規登録しました');
            Session::flash('alert-class', 'alert-success');
        } catch (\Exception | \Throwable $e) {
            DB::rollBack();
            \Log::error($e);
            Session::flash('error', 'エラーが発生しました');
            Session::flash('alert-class', 'alert-danger');
        } finally {
            return redirect(route('admin.wiki.index'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wiki = Wiki::find($id);
        return view('admin.wiki.edit', compact('wiki'));
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
        try {
            DB::beginTransaction();

            $wiki         = Wiki::find($id);
            $wiki->title  = $request->title;
            $wiki->body   = $request->body;
            $wiki->disp   = $request->disp;
            $wiki->save();

            DB::commit();
            Session::flash('message', '更新しました');
            Session::flash('alert-class', 'alert-success');
        } catch (\Exception | \Throwable $e) {
            DB::rollBack();
            \Log::error($e);
            Session::flash('error', 'エラーが発生しました');
            Session::flash('alert-class', 'alert-danger');
        } finally {
            return redirect(route('admin.wiki.index'));
        }
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
}
