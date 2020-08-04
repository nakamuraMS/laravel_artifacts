<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateRemindMailRequest;
use App\Models\RemindMail;

class RemindMailController extends Controller
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
            return DataTables::of(RemindMail::query()->select())
            ->addIndexColumn()
            ->addColumn('edit', function($row){
                $url = route('admin.remind_mail.edit', ['remind_mail_id' => $row->id]);
                $btn = '<a class="btn btn-success btn-block" href="' . $url . '" role="button">編集</a>';
                return $btn;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('admin.remind_mail.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.remind_mail.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateRemindMailRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateRemindMailRequest $request)
    {
        try {
            DB::beginTransaction();

            $remind_mail            = new RemindMail();
            $remind_mail->title     = $request->title;
            $remind_mail->body      = $request->body;
            $remind_mail->datetime  = $this->dateFormat($request);
            $remind_mail->save();

            DB::commit();
            Session::flash('message', '新規登録しました');
            Session::flash('alert-class', 'alert-success');
        } catch (\Exception | \Throwable $e) {
            DB::rollBack();
            \Log::error($e);
            Session::flash('error', 'エラーが発生しました');
            Session::flash('alert-class', 'alert-danger');
        } finally {
            return redirect(route('admin.remind_mail.index'));
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
        $remind_mail = RemindMail::find($id);
        return view('admin.remind_mail.edit', compact('remind_mail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateRemindMailRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateRemindMailRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $remind_mail            = RemindMail::find($id);
            $remind_mail->title     = $request->title;
            $remind_mail->body      = $request->body;
            $remind_mail->datetime  = $this->dateFormat($request);
            $remind_mail->save();

            DB::commit();
            Session::flash('message', '更新しました');
            Session::flash('alert-class', 'alert-success');
        } catch (\Exception | \Throwable $e) {
            DB::rollBack();
            \Log::error($e);
            Session::flash('error', 'エラーが発生しました');
            Session::flash('alert-class', 'alert-danger');
        } finally {
            return redirect(route('admin.remind_mail.index'));
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
        try {
            DB::beginTransaction();

            $remind_mail = RemindMail::find($id);
            $remind_mail->delete();

            DB::commit();
            Session::flash('message', '削除しました');
            Session::flash('alert-class', 'alert-success');
        } catch (\Exception | \Throwable $e) {
            DB::rollBack();
            \Log::error($e);
            Session::flash('error', 'エラーが発生しました');
            Session::flash('alert-class', 'alert-danger');
        } finally {
            return redirect(route('admin.remind_mail.index'));
        }
    }

    /**
     * 公開日時を整形して返す
     *
     * @param [type] $request
     * @return Carbon
     */
    public function dateFormat($request)
    {
        if (isset($request->date_year)) {
            $releaseDateTime = Carbon::parse(
                $request->date_year.'-'.$request->date_month.'-'.$request->date_day.' '.$request->date_hour.':'.$request->date_minute
            );
            return $releaseDateTime;
        } else {
            return null;
        }
    }
}
