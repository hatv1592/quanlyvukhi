<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CancunhapkhoFormRequest extends Request
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
            'cancunhapkho_name' => 'required|max:255',
            'cancunhapkho_coquan' => 'required|max:255',
            'cancunhapkho_code' => 'required|max:20',
            'cancunhapkho_number' => 'required|max:20',
            'cancunhapkho_date' => 'required|date',
            'cancunhapkho_note' => 'max:255'
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
            'cancunhapkho_name.required'  => 'Vui lòng nhập tên căn cứ nhập kho.',
            'cancunhapkho_name.max' => 'Tên căn cứ nhập kho không được vượt quá :max kí tự.',
            'cancunhapkho_coquan.required' => 'Vui lòng nhập tên cơ quan ra lệnh.',
            'cancunhapkho_coquan.max' => 'Tên cơ quan ra lệnh không được vượt quá :max kí tự.',
            'cancunhapkho_code.required' => 'Vui lòng nhập mã lệnh.',
            'cancunhapkho_code.max' => 'Mã lệnh không được vượt quá :max kí tự.',
            'cancunhapkho_number.required'  => 'Vui lòng nhập số lệnh.',
            'cancunhapkho_number.max'  => 'Số lệnh không được vượt quá :max kí tự.',
            'cancunhapkho_date.required'  => 'Vui lòng nhập ngày nhận lệnh.',
            'cancunhapkho_date.date'  => 'Định dạnh ngày tháng nhận không hợp lệ.',
            'cancunhapkho_note.max'  => 'Ghi chú không được vượt quá :max kí tự.',
        ];
    }
}
