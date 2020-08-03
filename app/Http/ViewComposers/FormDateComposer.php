<?php

namespace App\Http\ViewComposers;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Config;

class FormDateComposer
{
    public function compose(View $view)
    {
        $view->with([
            // セレクトボックス用リスト
            'now'        => Carbon::now(),
            'formYear'   => $this->formYear(),
            'formMonth'  => Config::get('constants.months'),
            'formDay'    => Config::get('constants.days'),
            'formHour'   => Config::get('constants.hours'),
            'formMinute' => Config::get('constants.minutes'),
        ]);
    }

    /**
     * 次の年までの配列を返す
     *
     * @return array
     */
    public function formYear()
    {
        $now = Carbon::now();
        $beginYear = $now->year;

        // 次の年までを表示
        $nextYear = $now->addYear(1);
        $endYear  = $nextYear->year;

        return [
            $beginYear => $beginYear,
            $endYear   => $endYear
        ];
    }
}
