<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DonViFormRequest extends Request
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
            'donvi_name' => 'required|max:255'
        ];

        if ((int) $this->input('donvi_vitri') === 1) {
            $rules['donvi_parent'] = 'required|integer';
        }

        return $rules;
    }

    /**
     * Custom errors messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'donvi_parent.required' => 'Vui lòng chọn đơn vị cha.',
            'donvi_parent.integer' => 'Đơn vị cha không hợp lệ',
            'donvi_name.required' => 'Vui lòng nhập tên đơn vị.',
            'donvi_name.max' => 'Tên đơn vị không được vượt quá :max kí tự.',
        ];
    }
}
