<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CoVuKhiFormRequest extends Request
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
            'nhomvukhi_id' => 'required|integer|between:0,127',
            'covukhi_code' => 'required|integer',
            'covukhi_name' => 'required|max:255'
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
            'nhomvukhi_id.required' => 'Vui lòng nhập mã nhóm vũ khí.',
            'nhomvukhi_id.integer' => 'Mã nhóm vũ khí phải là số nguyên.',
            'nhomvukhi_id.between' => 'Mã nhóm vũ khí chỉ được phép nhập từ :min đến :max.',
            'covukhi_code.required' => 'Vui lòng nhập mã cỡ vũ khí.',
            'covukhi_code.integer' => 'Mã cỡ vũ khí phải là số nguyên.',
            'covukhi_name.required'  => 'Vui lòng nhập tên cỡ vũ khí.',
            'covukhi_name.max'  => 'Tên cỡ vũ khí không được vượt quá :max kí tự.'
        ];
    }
}
