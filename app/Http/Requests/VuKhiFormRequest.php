<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class VuKhiFormRequest extends Request
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
            'covukhi_id' => 'required|integer',
            'vukhi_code' => 'integer',
            'vukhi_name' => 'required|max:255',
            'vukhi_kyhieu' => 'max:20',
            'vukhi_trongluong' => 'numeric',
            'vukhi_dai' => 'numeric',
            'vukhi_rong' => 'numeric',
            'vukhi_cao' => 'numeric'
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
            'covukhi_id.required' => 'Vui lòng chọn kích cỡ vũ khí.',
            'covukhi_id.integer' => 'Dữ liệu kích cỡ vũ khí không hợp lệ.',
            'vukhi_code.integer' => 'Mã vũ khí phải là số nguyên.',
            'vukhi_name.required' => 'Vui lòng nhập tên vũ khí.',
            'vukhi_name.max' => 'Tên vũ khí không được vượt quá :max kí tự.',
            'vukhi_kyhieu.max' => 'Ký hiệu vũ khí không được vượt quá :max kí tự.',
            'vukhi_trongluong.numeric' => 'Trọng lượng vũ khí phải là số.',
            'vukhi_dai.numeric' => 'Chiều dài vũ khí phải là số.',
            'vukhi_rong.numeric' => 'Chiều rộng vũ khí phải là số.',
            'vukhi_cao.numeric' => 'Chiều cao vũ khí phải là số.'
        ];
    }
}
