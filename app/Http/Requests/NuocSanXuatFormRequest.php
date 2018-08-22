<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NuocSanXuatFormRequest extends Request
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
            'hevukhi_id' => 'required|integer|max:255',
            'nuocsanxuat_name' => 'required|max:255'
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
            'hevukhi_id.integer' => 'Hệ vũ khí không hợp lệ.',
            'hevukhi_id.max' => 'Hệ vũ khí không hợp lệ.',
            'nuocsanxuat_name.required' => 'Vui lòng nhập tên nước sản xuất.',
            'nuocsanxuat_name.max' => 'Tên nước sản xuất không được vượt quá :max kí tự.',
        ];
    }
}
