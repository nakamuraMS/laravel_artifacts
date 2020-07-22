<?php

namespace App\Http\Requests;

use App\Models\Wiki;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateWikiRequest extends FormRequest
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
        $disp = implode(',', array_keys(Wiki::DISP));
        return [
            'title'       => 'required|max:70',
            'body'        => 'required',
            'disp'        => 'required|in:' . $disp,
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'title'       => 'タイトル',
            'body'        => '文章',
            'disp'        => '公開制御',
        ];
    }

    public function messages()
    {
        return [
            'title.required'          => ':attributeを入力してください。',
            'title.max'               => ':attributeは:max文字以内で入力してください。',
            'body.required'           => ':attributeを入力してください。',
            'disp.required'           => ':attributeを指定してください。',
            'disp.in'                 => ':attributeに不正な値を指定しています。',
        ];
    }
}
