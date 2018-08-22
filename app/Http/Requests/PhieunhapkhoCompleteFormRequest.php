<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PhieunhapkhoCompleteFormRequest extends Request
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
            'cancunhapkho_id' => 'required',
            'donvinhap_id' => 'required',
            'lydonhapkho_id' => 'required',
            'donvixuat_name' => 'required',
            'pnk_ngay_hethan' => 'required|date_format:"d/m/Y"',
            'pnk_donvivanchuyen' => 'required',
            'pnk_nguoinhanhang' => 'required',
            'pnk_phuongtienvanchuyen' => 'required',
            'pnk_nguoinhanphieu' => 'required',
            'pnk_nguoiralenh' => 'required'
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
            'cancunhapkho_id.required'  => 'Vui lòng chọn căn cứ nhập kho.',
            'donvinhap_id.required' => 'Vui lòng chọn đơn vị nhập.',
            'lydonhapkho_id.required' => 'Vui lòng chọn lý do nhập kho.',
            'donvixuat_name.required' => 'Vui lòng nhập đơn vị xuất.',
            'pnk_ngay_hethan.required' => 'Vui lòng chọn ngày hết hạn.',
            'pnk_ngay_hethan.date_format'  => 'Định dạnh ngày tháng hết hạn không hợp lệ(ví dụ: 01/01/1970).',
            'pnk_donvivanchuyen.required' => 'Vui lòng nhập tên đơn vị vận chuyển.',
            'pnk_nguoinhanhang.required' => 'Vui lòng nhập tên người nhận hàng.',
            'pnk_phuongtienvanchuyen.required' => 'Vui lòng nhập tên phương tiện vận chuyển.',
            'pnk_nguoinhanphieu.required' => 'Vui lòng nhập tên người nhận phiếu.',
            'pnk_nguoiralenh.required' => 'Vui lòng nhập tên người ra lệnh.'
        ];
    }
}
