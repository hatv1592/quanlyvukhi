<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PhieunhapkhoFormRequest extends Request
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
            'pnk_nguoiralenh' => 'required',
            'hevukhi_id' => 'required',
            'nhomvukhi_id' => 'required',
            'covukhi_id' => 'required',
            'vukhi_id' => 'required',
            'donvitinh_id' => 'required',
            'nuocsanxuat_id' => 'required'
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
            'pnk_nguoiralenh.required' => 'Vui lòng nhập tên người ra lệnh.',
            'hevukhi_id.required' => 'Vui lòng chọn hệ vũ khi.',
            'nhomvukhi_id.required' => 'Vui lòng chọn nhóm vũ khí.',
            'covukhi_id.required' => 'Vui lòng chọn cỡ vũ khí.',
            'vukhi_id.required' => 'Vui lòng chọn vũ khí.',
            'donvitinh_id.required' => 'Vui lòng chọn đơn vị tính.',
            'nuocsanxuat_id.required' => 'Vui lòng chọn nước sản xuất.'
        ];
    }
}
