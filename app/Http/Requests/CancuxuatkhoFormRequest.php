<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CancuxuatkhoFormRequest extends Request
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
            'cancuxuatkho_name' => 'required|max:255',
            'cancuxuatkho_cqralenh' => 'required|max:255',
            'cancuxuatkho_code' => 'required|max:20',
            'cancuxuatkho_number' => 'required|max:20',
            'cancuxuatkho_date' => 'required|date',
            'cancuxuatkho_note' => 'max:255'
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
            'cancuxuatkho_name.required'  => 'Vui lòng nhập tên căn cứ xuất kho.',
            'cancuxuatkho_name.max' => 'Tên căn cứ xuất kho không được vượt quá :max kí tự.',
            'cancuxuatkho_cqralenh.required' => 'Vui lòng nhập tên cơ quan ra lệnh.',
            'cancuxuatkho_cqralenh.max' => 'Tên cơ quan ra lệnh không được vượt quá :max kí tự.',
            'cancuxuatkho_code.required' => 'Vui lòng nhập mã lệnh.',
            'cancuxuatkho_code.max' => 'Mã lệnh không được vượt quá :max kí tự.',
            'cancuxuatkho_number.required'  => 'Vui lòng nhập số lệnh.',
            'cancuxuatkho_number.max'  => 'Số lệnh không được vượt quá :max kí tự.',
            'cancuxuatkho_date.required'  => 'Vui lòng nhập ngày nhận lệnh.',
            'cancuxuatkho_date.date'  => 'Định dạnh ngày tháng nhận không hợp lệ.',
            'cancuxuatkho_note.max'  => 'Ghi chú không được vượt quá :max kí tự.',
        ];
    }
}
