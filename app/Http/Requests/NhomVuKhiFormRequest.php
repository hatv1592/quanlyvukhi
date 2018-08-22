<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NhomVuKhiFormRequest extends Request
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
            'hevukhi_id' => 'required|numeric|between:0,127',
            'nhomvukhi_code' => 'required|max:2',
            'nhomvukhi_name' => 'required|max:255'
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
            'hevukhi_id.required' => 'Vui lòng chọn hệ vũ khí.',
            'hevukhi_id.numeric' => 'Dữ liệu hệ vũ khí không hợp lệ.',
            'hevukhi_id.between' => 'Dữ liệu hệ vũ khí không hợp lệ.',
            'nhomvukhi_code.required' => 'Vui lòng nhập mã nhóm vũ khí.',
            'nhomvukhi_code.max' => 'Mã nhóm vũ khí không được vượt quá :max kí tự.',
            'nhomvukhi_name.required' => 'Vui lòng nhập tên nhóm vũ khí.',
            'nhomvukhi_name.max' => 'Tên nhóm vũ khí không được vượt quá :max kí tự.'
        ];
    }
}
