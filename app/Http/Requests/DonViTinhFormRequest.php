<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DonViTinhFormRequest extends Request
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
            'donvitinh_name' => 'required|max:255'
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
            'donvitinh_name.required' => 'Vui lòng nhập tên đơn vị tính.',
            'donvitinh_name.max' => 'Tên đơn vị tính không được vượt quá :max kí tự.',
        ];
    }
}
