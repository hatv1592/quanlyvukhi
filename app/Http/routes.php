<?php
date_default_timezone_set('Asia/Bangkok');
/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

// Auth
//Route::get('/', ['as' => 'login.login', 'uses' => 'Login\LoginController@index']);
//Route::post('/dologin', ['as' => 'login.dologin', 'uses' => 'Login\LoginController@doLogin']);
Route:: get('error', 'HomeController@error');
Route:: get('login', 'Auth\AuthController@showLoginForm');
Route:: post('login', 'Auth\AuthController@login');
Route:: get('logout', 'Auth\AuthController@logout');
//Route::get('/home', 'HomeController@index');
Route:: get('', 'HomeController@index')->middleware('AuthLogin');

// Ton kho
Route::group(['prefix' => 'tonkho', 'namespace' => 'Tonkho', 'middleware' => 'AuthLogin'], function () {
    Route::get('/nhaptondau', ['as' => 'tonkho.index', 'uses' => 'TonkhoController@index']);
    Route::post('/nhaptondau', ['as' => 'tonkho.create', 'uses' => 'TonkhoController@create']);
    Route::get('/nhaptondau/edit/{id}', ['as' => 'tonkho.edit', 'uses' => 'TonkhoController@edit']);
    Route::post('/nhaptondau/update/{id}', ['as' => 'tonkho.update', 'uses' => 'TonkhoController@update']);
    Route::get('/nhaptondau/delete/{id}', ['as' => 'tonkho.delete', 'uses' => 'TonkhoController@destroy']);
    Route::get('/gettableoption', ['as' => 'tonkho.getComboBox', 'uses' => 'TonkhoController@getTableOption']);
});

// Xuat - Nhap
Route::group(['prefix' => 'xuatnhap', 'namespace' => 'Xuatnhap', 'middleware' => 'AuthLogin'], function () {
    //List phieu xuat kho
    Route::get('/', ['as' => 'xuatnhap.dsxuatkho', 'uses' => 'PhieuxuatkhoController@index']);
    Route::get('/dsxuatkho', ['as' => 'xuatnhap.dsxuatkho', 'uses' => 'PhieuxuatkhoController@index']);
    Route::get('/phieuxuatkho/edit/{id}', ['as' => 'xuatnhap.phieuxuatkho.edit', 'uses' => 'PhieuxuatkhoController@edit']);
    Route::post('/phieuxuatkho/edit/{id}', ['as' => 'xuatnhap.phieuxuatkho.update', 'uses' => 'PhieuxuatkhoController@update']);
    Route::get('/phieuxuatkho/delete/{id}', ['as' => 'xuatnhap.phieuxuatkho.delete', 'uses' => 'PhieuxuatkhoController@destroy']);
    Route::any('/phieuxuatkho/confirm/{id}', ['as' => 'xuatnhap.phieuxuatkho.confirm', 'uses' => 'PhieuxuatkhoController@confirm']);
    Route::any('/phieuxuatkho/admin_confirm/{id}', ['as' => 'xuatnhap.phieuxuatkho.admin_confirm', 'uses' => 'PhieuxuatkhoController@admin_confirm']);
    Route::any('/phieuxuatkho/admin_delete/{id}', ['as' => 'xuatnhap.phieuxuatkho.admin_delete', 'uses' => 'PhieuxuatkhoController@admin_delete']);
    Route::any('/phieuxuatkho/remove_item/{id}', ['as' => 'xuatnhap.phieuxuatkho.remove_item', 'uses' => 'PhieuxuatkhoController@remove_item']);

    Route::get('/getthongsothucluc', ['as' => 'xuatnhap.getthongsothucluc', 'uses' => 'PhieuxuatkhoController@thongSoThucLuc']);
    Route::get('/gettableoption/{donvi_id}', ['as' => 'xuatnhap.gettableoption', 'uses' => 'PhieuxuatkhoController@getTableOption']);
    //Màn hình tạo và lưu phiếu xuất kho
    Route::get('/taophieuxuatkho', ['as' => 'xuatnhap.phieuxuatkho.create', 'uses' => 'PhieuxuatkhoController@create']);
    Route::post('/taophieuxuatkho', ['as' => 'xuatnhap.phieuxuatkho.store', 'uses' => 'PhieuxuatkhoController@store']);
    //Màn hình xuất nhập in
    Route::get('xuatkho/print/{id}', ['as' => 'xuatnhap.inphieuxuatkho', 'uses' => 'XuatnhapPrintController@printPhieuXuat']);
    Route::get('nhapkho/print/{id}', ['as' => 'xuatnhap.inphieunhapkho', 'uses' => 'XuatnhapPrintController@printPhieuNhap']);

    // Xuat kho group
    Route::group(['prefix' => 'xuatkho', 'namespace' => 'Xuatkho'], function () {
        // Can cu xuat kho
        Route::get('/cancuxuatkho', ['as' => 'xuatnhap.xuatkho.cancuxuatkho.index', 'uses' => 'CancuxuatkhoController@index']);
        Route::get('/cancuxuatkho/edit/{id}', ['as' => 'xuatnhap.xuatkho.cancuxuatkho.view', 'uses' => 'CancuxuatkhoController@view']);
        Route::post('/cancuxuatkho', ['as' => 'xuatnhap.xuatkho.cancuxuatkho.create', 'uses' => 'CancuxuatkhoController@create']);
        Route::delete('/cancuxuatkho/{id}', ['as' => 'xuatnhap.xuatkho.cancuxuatkho.destroy', 'uses' => 'CancuxuatkhoController@destroy']);
        Route::post('/cancuxuatkho/update/{id}', ['as' => 'xuatnhap.xuatkho.cancuxuatkho.update', 'uses' => 'CancuxuatkhoController@update']);
    });

    // Nhap kho group
    Route::group(['prefix' => 'nhapkho', 'namespace' => 'Nhapkho'], function () {
        // Can cu nhap kho
        Route::get('/cancunhapkho', ['as' => 'xuatnhap.nhapkho.cancunhapkho.index', 'uses' => 'CancunhapkhoController@index']);
        Route::get('/cancunhapkho/edit/{id}', ['as' => 'xuatnhap.nhapkho.cancunhapkho.view', 'uses' => 'CancunhapkhoController@view']);
        Route::post('/cancunhapkho', ['as' => 'xuatnhap.nhapkho.cancunhapkho.create', 'uses' => 'CancunhapkhoController@create']);
        Route::delete('/cancunhapkho/{id}', ['as' => 'xuatnhap.nhapkho.cancunhapkho.destroy', 'uses' => 'CancunhapkhoController@destroy']);
        Route::post('/cancunhapkho/update/{id}', ['as' => 'xuatnhap.nhapkho.cancunhapkho.update', 'uses' => 'CancunhapkhoController@update']);

        //Confirm Phieu nhap kho
        Route::any('/phieunhapkho/confirm/{id}', ['as' => 'xuatnhap.phieunhapkho.confirm', 'uses' => 'PhieunhapkhoController@confirm']);
        Route::any('/phieunhapkho/admin_confirm/{id}', ['as' => 'xuatnhap.phieunhapkho.admin_confirm', 'uses' => 'PhieunhapkhoController@admin_confirm']);
        Route::any('/phieunhapkho/admin_delete/{id}', ['as' => 'xuatnhap.phieunhapkho.admin_delete', 'uses' => 'PhieunhapkhoController@admin_delete']);
        // Phieu nhap kho
        Route::get('/phieunhapkho', ['as' => 'xuatnhap.nhapkho.phieunhapkho.index', 'uses' => 'PhieunhapkhoController@index']);
        Route::get('/phieunhapkho/form', ['as' => 'xuatnhap.nhapkho.phieunhapkho.form', 'uses' => 'PhieunhapkhoController@form']);
        Route::get('/phieunhapkho/edit/{id}', ['as' => 'xuatnhap.nhapkho.phieunhapkho.view', 'uses' => 'PhieunhapkhoController@view']);
        Route::post('/phieunhapkho/create', ['as' => 'xuatnhap.nhapkho.phieunhapkho.create', 'uses' => 'PhieunhapkhoController@create']);
        Route::post('/phieunhapkho/complete', ['as' => 'xuatnhap.nhapkho.phieunhapkho.complete', 'uses' => 'PhieunhapkhoController@complete']);
        Route::delete('/phieunhapkho/{id}', ['as' => 'xuatnhap.nhapkho.phieunhapkho.destroy', 'uses' => 'PhieunhapkhoController@destroy']);
        Route::post('/phieunhapkho/update/{id}', ['as' => 'xuatnhap.nhapkho.phieunhapkho.update', 'uses' => 'PhieunhapkhoController@update']);
        Route::delete('/phieunhapkho/vukhi/{id}', ['as' => 'xuatnhap.nhapkho.phieunhapkho.deleteVukhiInPhieunhapkho', 'uses' => 'PhieunhapkhoController@deleteVukhiInPhieunhapkho']);
        Route::get('/phieunhapkho/{id}', ['as' => 'xuatnhap.nhapkho.phieunhapkho.edit', 'uses' => 'PhieunhapkhoController@edit']);
    });
});

// Quan tri
Route::group(['prefix' => 'quantri', 'namespace' => 'Quantri', 'middleware' => 'AuthLogin'], function () {

    Route::group(['prefix' => 'quantringuoidung', 'namespace' => 'Quantringuoidung', 'middleware' => 'AuthLogin'], function () {
        Route::get('/thanhvien', ['as' => 'quantri.quantringuoidung.user.index', 'uses' => 'UserController@index']);
        Route::post('/thanhvien', ['as' => 'quantri.quantringuoidung.user.create', 'uses' => 'UserController@create']);
        Route::get('/thanhvien/delete/{id}', ['as' => 'quantri.quantringuoidung.user.destroy', 'uses' => 'UserController@destroy']);
        Route::get('/thanhvien/edit/{id}', ['as' => 'quantri.quantringuoidung.user.view', 'uses' => 'UserController@view']);
        Route::post('/thanhvien/update/{id}', ['as' => 'quantri.quantringuoidung.user.update', 'uses' => 'UserController@update']);
    });

    Route::group(['prefix' => 'nhapxuat', 'middleware' => 'AuthLogin'], function () {
        Route::get('/lydoxuatkho', ['as' => 'quantri.xuatnhap.lydoxuatkho', 'uses' => 'XuatnhapadminController@lydoxuatkho']);
        Route::post('/lydoxuatkho', ['as' => 'quantri.xuatnhap.taolydoxuatkho', 'uses' => 'XuatnhapadminController@taolydoxuatkho']);
        Route::get('/lydonhapkho', ['as' => 'quantri.xuatnhap.lydonhapkho', 'uses' => 'XuatnhapadminController@lydonhapkho']);
        Route::post('/lydonhapkho', ['as' => 'quantri.xuatnhap.taolydonhapkho', 'uses' => 'XuatnhapadminController@taolydonhapkho']);
    });

    Route::group(['prefix' => 'danhmucvukhi', 'namespace' => 'Danhmucvukhi', 'middleware' => 'AuthLogin'], function () {
        //he vũ khi
        Route::get('/hevukhi', ['as' => 'quantri.danhmucvukhi.hevukhi.index', 'uses' => 'HeVuKhiController@index']);
        Route::post('/hevukhi', ['as' => 'quantri.danhmucvukhi.hevukhi.create', 'uses' => 'HeVuKhiController@create']);
        Route::delete('/hevukhi/{id}', ['as' => 'quantri.danhmucvukhi.hevukhi.destroy', 'uses' => 'HeVuKhiController@destroy']);
        Route::get('/hevukhi/edit/{id}', ['as' => 'quantri.danhmucvukhi.hevukhi.view', 'uses' => 'HeVuKhiController@view']);
        Route::post('/hevukhi/update/{id}', ['as' => 'quantri.danhmucvukhi.hevukhi.update', 'uses' => 'HeVuKhiController@update']);

        // Nhóm vũ khí
        Route::get('/nhomvukhi', ['as' => 'quantri.danhmucvukhi.nhomvukhi.index', 'uses' => 'NhomVuKhiController@index']);
        Route::get('/nhomvukhi/edit/{id}', ['as' => 'quantri.danhmucvukhi.nhomvukhi.view', 'uses' => 'NhomVuKhiController@view']);
        Route::post('/nhomvukhi', ['as' => 'quantri.danhmucvukhi.nhomvukhi.create', 'uses' => 'NhomVuKhiController@create']);
        Route::delete('/nhomvukhi/{id}', ['as' => 'quantri.danhmucvukhi.nhomvukhi.destroy', 'uses' => 'NhomVuKhiController@destroy']);
        Route::post('/nhomvukhi/update/{id}', ['as' => 'quantri.danhmucvukhi.nhomvukhi.update', 'uses' => 'NhomVuKhiController@update']);

        //co vu khi
        Route::get('/covukhi', ['as' => 'quantri.danhmucvukhi.covukhi.index', 'uses' => 'CoVuKhiController@index']);
        Route::get('/covukhi/edit/{id}', ['as' => 'quantri.danhmucvukhi.covukhi.view', 'uses' => 'CoVuKhiController@view']);
        Route::post('/covukhi', ['as' => 'quantri.danhmucvukhi.covukhi.create', 'uses' => 'CoVuKhiController@create']);
        Route::delete('/covukhi/{id}', ['as' => 'quantri.danhmucvukhi.covukhi.destroy', 'uses' => 'CoVuKhiController@destroy']);
        Route::post('/covukhi/update/{id}', ['as' => 'quantri.danhmucvukhi.covukhi.update', 'uses' => 'CoVuKhiController@update']);

        // Kieu vu khi
        Route::get('/kieuvukhi', ['as' => 'quantri.danhmucvukhi.vukhi.index', 'uses' => 'VuKhiController@index']);
        Route::get('/kieuvukhi/edit/{id}', ['as' => 'quantri.danhmucvukhi.vukhi.view', 'uses' => 'VuKhiController@view']);
        Route::post('/kieuvukhi', ['as' => 'quantri.danhmucvukhi.vukhi.create', 'uses' => 'VuKhiController@create']);
        Route::delete('/kieuvukhi/{id}', ['as' => 'quantri.danhmucvukhi.vukhi.destroy', 'uses' => 'VuKhiController@destroy']);
        Route::post('/kieuvukhi/update/{id}', ['as' => 'quantri.danhmucvukhi.vukhi.update', 'uses' => 'VuKhiController@update']);

        Route::get('/suahevukhi', ['as' => 'quantri.danhmucvukhi.suahevukhi', 'uses' => 'DanhMucVuKhiController@suahevukhi']);
        Route::post('/luuhevukhi', ['as' => 'quantri.danhmucvukhi.luuhevukhi', 'uses' => 'DanhMucVuKhiController@luuhevukhi']);
    });

    // Danh muc don vi group
    Route::group(['prefix' => 'danhmucdonvi', 'namespace' => 'Danhmucdonvi'], function () {
        // Don vi
        Route::get('/donvi', ['as' => 'quantri.danhmucdonvi.donvi.index', 'uses' => 'DonViController@index']);
        Route::post('/donvi', ['as' => 'quantri.danhmucdonvi.donvi.create', 'uses' => 'DonViController@create']);
        Route::delete('/donvi/{id}', ['as' => 'quantri.danhmucdonvi.donvi.destroy', 'uses' => 'DonViController@destroy']);
        Route::get('/donvi/edit/{id}', ['as' => 'quantri.danhmucdonvi.donvi.view', 'uses' => 'DonViController@view']);
        Route::post('/donvi/update/{id}', ['as' => 'quantri.danhmucdonvi.donvi.update', 'uses' => 'DonViController@update']);
        Route::get('/donvi/detail/{id}', ['as' => 'quantri.danhmucdonvi.donvi.detail', 'uses' => 'DonViController@detail']);
    });

    // Danh muc khac group
    Route::group(['prefix' => 'danhmuckhac', 'namespace' => 'Danhmuckhac'], function () {
        // Don vi tinh
        Route::get('/donvitinh', ['as' => 'quantri.danhmuckhac.donvitinh.index', 'uses' => 'DonViTinhController@index']);
        Route::post('/donvitinh', ['as' => 'quantri.danhmuckhac.donvitinh.create', 'uses' => 'DonViTinhController@create']);
        Route::delete('/donvitinh/{id}', ['as' => 'quantri.danhmuckhac.donvitinh.destroy', 'uses' => 'DonViTinhController@destroy']);
        Route::get('/donvitinh/edit/{id}', ['as' => 'quantri.danhmuckhac.donvitinh.view', 'uses' => 'DonViTinhController@view']);
        Route::post('/donvitinh/update/{id}', ['as' => 'quantri.danhmuckhac.donvitinh.update', 'uses' => 'DonViTinhController@update']);

        // Nuoc san xuat
        Route::get('/nuocsanxuat', ['as' => 'quantri.danhmuckhac.nuocsanxuat.index', 'uses' => 'NuocSanXuatController@index']);
        Route::post('/nuocsanxuat', ['as' => 'quantri.danhmuckhac.nuocsanxuat.create', 'uses' => 'NuocSanXuatController@create']);
        Route::delete('/nuocsanxuat/{id}', ['as' => 'quantri.danhmuckhac.nuocsanxuat.destroy', 'uses' => 'NuocSanXuatController@destroy']);
        Route::get('/nuocsanxuat/edit/{id}', ['as' => 'quantri.danhmuckhac.nuocsanxuat.view', 'uses' => 'NuocSanXuatController@view']);
        Route::post('/nuocsanxuat/update/{id}', ['as' => 'quantri.danhmuckhac.nuocsanxuat.update', 'uses' => 'NuocSanXuatController@update']);
    });
});

// Báo cáo
Route::group(['prefix' => 'report', 'namespace' => 'Report', 'middleware' => 'AuthLogin'], function () {

    //Báo cáo 1: Báo cáo tình hình xuất, nhập Súng pháo khí tài (Mẫu 22/08/QK-VK)
    Route::get('/tinhhinhxuatnhap', ['as' => 'report.tinhhinhxuatnhap', 'uses' => 'ReportXuatNhapController@index']);
//    Route::post('/tinhhinhxuatnhap', ['as' => 'report.tinhhinhxuatnhap', 'uses' => 'ReportXuatNhapController@show']);

    //2. Báo cáo 2: Báo cáo Tăng giảm thực lực súng pháo khí tài (Mẫu 23/08/QK-VK)
    Route::get('/tanggiamthucluc', ['as' => 'report.tanggiamthucluc', 'uses' => 'ReportTangGiamThucLucController@index']);
//    Route::post('/tanggiamthucluc', ['as' => 'report.tanggiamthucluc', 'uses' => 'ReportTangGiamThucLucController@show']);

    //Báo cáo 3: Báo cáo tồn kho Súng pháo khí tài Quý …. Năm ….. (Mẫu số 24/08/QK-VK)
    Route::get('/baocaotonkho', ['as' => 'report.baocaotonkho', 'uses' => 'ReportTonKhoController@index']);
//    Route::post('/baocaotonkho', ['as' => 'report.baocaotonkho', 'uses' => 'ReportTonKhoController@show']);

    //Báo cáo 4: Báo cáo Kiểm kê súng pháo khí tài ở kho (Mẫu số 28/08/QK-VK)
    Route::get('/baocaokiemke', ['as' => 'report.baocaokiemke', 'uses' => 'ReportKiemKeController@index']);
//    Route::post('/baocaokiemke', ['as' => 'report.baocaokiemke', 'uses' => 'ReportKiemKeController@show']);
});
// Báo cáo
Route::group(['prefix' => 'backup', 'namespace' => 'Backup', 'middleware' => 'AuthLogin'], function () {
    //BÁO CÁO KIỂM KÊ SÚNG PHÁO KHÍ TÀI Ở KHO
    Route::get('/', ['as' => 'backup.index', 'uses' => 'BackUpController@index']);
    Route::post('/storage', ['as' => 'backup.storage', 'uses' => 'BackUpController@storage']);
    Route::get('/restore', ['as' => 'backup.restoreindex', 'uses' => 'BackUpController@restoreIndex']);
    Route::post('/restore', ['as' => 'backup.restore', 'uses' => 'BackUpController@restore']);
});
Route::group(['prefix' => 'sync', 'namespace' => 'Sync', 'middleware' => 'AuthLogin'], function () {
    Route::group(['prefix' => 'nhapkho'], function () {
        //Đồng bộ
        Route::any('/index', ['as' => 'sync.nhapkho', 'uses' => 'SyncNhapKhoController@index']);
        Route::any('/compare', ['as' => 'sync.nhapkho.compare', 'uses' => 'SyncNhapKhoController@compare']);
    });
    Route::group(['prefix' => 'xuatkho'], function () {
        //Đồng bộ
        Route::any('/index', ['as' => 'sync.xuatkho.index', 'uses' => 'SyncXuatKhoController@index']);
        Route::any('/compare', ['as' => 'sync.xuatkho.compare', 'uses' => 'SyncXuatKhoController@compare']);
    });
    Route::group(['prefix' => 'tonkho'], function () {
        //Đồng bộ
        Route::any('/index', ['as' => 'sync.tonkho.index', 'uses' => 'SyncTonKhoController@index']);
        Route::any('/compare', ['as' => 'sync.tonkho.compare', 'uses' => 'SyncTonKhoController@compare']);
    });
});

// API
Route::group(['prefix' => 'api', 'namespace' => 'Api', 'middleware' => 'AuthLogin'], function () {
    Route::get('/v1/hevukhi/{hevukhiId}/nhomvukhi', ['uses' => 'HevukhiController@nhomvukhi']);
    Route::get('/v1/hevukhi/{hevukhiId}/nuocsanxuat', ['uses' => 'HevukhiController@nuocsanxuat']);
    Route::get('/v1/nhomvukhi/{nhomvukhiId}/covukhi', ['uses' => 'NhomvukhiController@covukhi']);
    Route::get('/v1/covukhi/{covukhiId}/vukhi', ['uses' => 'CovukhiController@vukhi']);
    Route::get('/v1/thuclucvukhi', ['uses' => 'ThuclucvukhiController@thuclucvukhi']);
    Route::get('/v1/search/lenhnhapkho', ['uses' => 'PhieunhapkhoController@index']);
    Route::get('/v1/search/lenhxuatkho', ['uses' => 'PhieuxuatkhoController@index']);
});

// Search
Route::group(['prefix' => 'search', 'namespace' => 'Search', 'middleware' => 'AuthLogin'], function () {
    Route::get('/thuclucvukhi', ['as' => 'search.thuclucvukhi', 'uses' => 'ThuclucVukhiController@index']);
    Route::get('/nhapkho', ['as' => 'search.nhapkho', 'uses' => 'NhapkhoController@index']);
    Route::get('/xuatkho', ['as' => 'search.xuatkho', 'uses' => 'XuatkhoController@index']);
});



