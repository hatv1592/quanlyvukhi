<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class HeVuKhiFormRequest extends Request
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
        return [
            'hevukhi_code' => 'required|numeric|between:0,127',
            'hevukhi_name' => 'required|max:255'
        ];
    }

    /**
     * Custom errors messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'hevukhi_code.required' => 'Vui lòng nhập mã hệ vũ khí.',
            'hevukhi_code.numeric' => 'Mã hệ vũ khí phải là số.',
            'hevukhi_code.unique' => 'Mã hệ vũ khí bị trùng lặp, vui lòng nhập mã khác.',
            'hevukhi_code.between' => 'Mã hệ vũ khí chỉ được phép nhập từ :min đến :max.',
            'hevukhi_name.required'  => 'Vui lòng nhập tên hệ vũ khí.',
            'hevukhi_name.max'  => 'Tên hệ vũ khí không được vượt quá :max kí tự.'
        ];
    }
}
