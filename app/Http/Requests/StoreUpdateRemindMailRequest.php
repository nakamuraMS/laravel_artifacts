<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateRemindMailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title'       => 'required|max:100',
            'body'        => 'required',
        ];

        return $rules;
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'title'       => 'タイトル',
            'body'        => '文章',
        ];
    }

    public function messages()
    {
        return [
            'title.required'          => ':attributeを入力してください。',
            'title.max'               => ':attributeは:max文字以内で入力してください。',
            'body.required'           => ':attributeを入力してください。',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $request = $this->all();

            // 日時のバリデーションをそれぞれ行う
            $this->validateDateTime(
                $request['date_year'],
                $request['date_month'],
                $request['date_day'],
                $request['date_hour'],
                $request['date_minute'],
                $validator
            );
        });
    }

    public function validateDateTime($year, $month, $day, $hour, $minute, $validator)
    {
        if (isset($year) || isset($month) || isset($day) || isset($hour) || isset($minute)) {
            $this->checkDateTime($year, $month, $day, $hour, $minute, $validator);
        }
    }

    public function checkDateTime($year, $month, $day, $hour, $minute, $validator) {
        // 項目の型チェック
        if(!(
            preg_match("/^[0-9]{4}$/"  , $year) &&
            preg_match("/^[0-9]{1,2}$/", $month) &&
            preg_match("/^[0-9]{1,2}$/", $day) &&
            preg_match("/^[0-9]{1,2}$/", $hour) &&
            preg_match("/^[0-9]{1,2}$/", $minute)
        )) {
            $validator->errors()->add('datetime', '日時を正しく指定してください。');
        }

        // 日付存在チェック
        if (!checkdate((int)$month, (int)$day, (int)$year)) {
            $validator->errors()->add('datetime', '存在する日付を指定してください。');
        }
    }
}
