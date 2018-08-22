<?php

namespace App\Http\Controllers\Quantri;

use App\Http\Controllers\Controller;

//use Illuminate\Http\Request;
//use App\Http\Requests;
use DB;
use Request;

class DanhmucvukhiController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * Màn hình chính quản lý hệ vũ khí
     */
    public function hevukhi()
    {
        $hevukhi = \App\Model\HevukhiModel::paginate(10);
        return view('quantri.danhmucvukhi.hevukhi')
            ->with('hevukhi', $hevukhi);
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * Lưu hệ vũ khí mới
     */
    public function taohevukhi()
    {
        $form_hevukhi = Request::input('hevukhi');
        $hevukhi = new \App\Model\HevukhiModel;
        if (count($form_hevukhi)) {
            $hevukhi->hevukhi_code = $form_hevukhi['hevukhi_code'];
            $hevukhi->hevukhi_name = $form_hevukhi['hevukhi_name'];
            if ($form_hevukhi['hevukhi_code'] && $form_hevukhi['hevukhi_code'] == 'on') {
                $hevukhi->hevukhi_active = 1;
            };
            if ($hevukhi->save()) {
                return redirect()->route('quantri.danhmucvukhi.hevukhi');
            } else {

            }
        }
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * Hành động xóa hệ vũ khi
     */
    public function xoataohevukhi($id)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * Màn hình sửa hệ vũ khi
     */
    public function suahevukhi()
    {
        $lydoxuatkho = \App\Model\LydoxuatkhoModel::paginate(10);
        return view('quantri.nhapxuat.lydoxuatkho')
            ->with('lydoxuatkho', $lydoxuatkho);
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * Sử lý dữ liệu sửa được gửi lên
     */
    public function luuhevukhi()
    {
        $lydoxuatkho = \App\Model\LydoxuatkhoModel::paginate(10);
        return view('quantri.nhapxuat.lydoxuatkho')
            ->with('lydoxuatkho', $lydoxuatkho);
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function taolydoxuatkho()
    {
        $form_lydoxuatkho = Request::input('lydoxuatkho');
        $lydoxuatkho = new \App\Model\LydoxuatkhoModel;
        $lydoxuatkho->lydoxuatkho_name = $form_lydoxuatkho['lydoxuatkho_name'];
        $lydoxuatkho->lydoxuatkho_note = $form_lydoxuatkho['lydoxuatkho_note'];
        if (!isset($form_lydoxuatkho['lydoxuatkho_active'])) {
            $lydoxuatkho->lydoxuatkho_active = 0;
        }
        $lydoxuatkho->save();
        return redirect()->route('quantri.xuatnhap.lydoxuatkho');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lydonhapkho()
    {
        $lydonhapkho = \App\Model\LydonhapkhoModel::paginate(5);
        return view('quantri.nhapxuat.lydonhapkho')
            ->with('lydonhapkho', $lydonhapkho);
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function taolydonhapkho()
    {
        $form_lydonhapkho = Request::input('lydonhapkho');
        $lydonhapkho = new \App\Model\LydonhapkhoModel;
        $lydonhapkho->lydonhapkho_name = $form_lydonhapkho['lydonhapkho_name'];
        $lydonhapkho->lydonhapkho_note = $form_lydonhapkho['lydonhapkho_note'];
        if (!isset($form_lydonhapkho['lydonhapkho_active'])) {
            $lydonhapkho->lydonhapkho_active = 0;
        }
        $lydonhapkho->save();
        return redirect()->route('quantri.xuatnhap.lydonhapkho');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function hoanthiennhapkho()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
