<?php

namespace App\Http\Controllers\Xuatnhap;

use App\Http\Controllers\Controller;

//use Illuminate\Http\Request;
//use App\Http\Requests;
use DB;
use Request;

class XuatnhapController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dslenhxuatkho()
    {
        $hevukhi = \App\Model\HevukhiModel::getArrayHeVuKhi();
        $donvitinh = \App\Model\DonvitinhModel::getArrayDonvitinh();
        return view('xuatnhap.xuatkho.dslenhxuatkho')
            ->with('donvitinh', $donvitinh)
            ->with('hevukhi', $hevukhi);
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function xuatkho()
    {

        $hevukhi = \App\Model\HevukhiModel::getArrayHeVuKhi();
        $donvitinh = \App\Model\DonvitinhModel::getArrayDonvitinh();
        return view('xuatnhap.xuatkho.xuatkho')
            ->with('donvitinh', $donvitinh)
            ->with('hevukhi', $hevukhi);
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dsxuatkho()
    {
        $phieu_xuat_kho = \App\Model\Xuatnhap\PhieuxuatkhoModel::get();
        return view('xuatnhap.xuatkho.dsxuatkho')
            ->with('phieu_xuat_kho', $phieu_xuat_kho);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nhapkho()
    {
        $hevukhi = \App\Model\HevukhiModel::getArrayHeVuKhi();
        $donvitinh = \App\Model\DonvitinhModel::getArrayDonvitinh();
        return view('xuatnhap.xuatkho.nhapkho')
            ->with('donvitinh', $donvitinh)
            ->with('hevukhi', $hevukhi);
        //
    }

    public function nhapcancuxuatkho()
    {
        $hevukhi = \App\Model\HevukhiModel::getArrayHeVuKhi();
        $donvitinh = \App\Model\DonvitinhModel::getArrayDonViTInh();
        if (Request::method() == 'POST' && Request::input('cancuxuatkho')) {
            $model = new \App\Model\Xuatnhap\CancuxuatkhoModel;

            $cancuxuatkho = Request::input('cancuxuatkho');
            $model->cancuxuatkho_code = $cancuxuatkho['cancuxuatkho_code'];

            $model->cancuxuatkho_number = $cancuxuatkho['cancuxuatkho_number'];

            $model->cancuxuatkho_cqralenh = $cancuxuatkho['cancuxuatkho_cqralenh'];
            if (isset($cancuxuatkho['cancuxuatkho_date']) && $cancuxuatkho['cancuxuatkho_date'] != null) {
                $date = \DateTime::createFromFormat('d-m-Y', $cancuxuatkho['cancuxuatkho_date']);
                if ($date) {
                }
                $model->cancuxuatkho_date = $date->format('Y-m-d');
            }
            $model->cancuxuatkho_name = $cancuxuatkho['cancuxuatkho_name'];
            $model->cancuxuatkho_note = $cancuxuatkho['cancuxuatkho_note'];
            if ($model->save()) {
                return redirect()->route('xuatnhap.nhapcancuxuatkho')->with('model', $model->getAttributes());
            }
        }
        $cancuxuatkho = \DB::table('cancuxuatkho')->orderBy('cancuxuatkho_id', 'desc')->paginate(10);
        return view('xuatnhap.xuatkho.nhapcancuxuatkho')
            ->with('donvitinh', $donvitinh)
            ->with('cancuxuatkho', $cancuxuatkho)
            ->with('hevukhi', $hevukhi);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public
    function hoanthiennhapkho()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public
    function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        //
    }

}
