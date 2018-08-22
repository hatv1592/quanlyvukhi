<?php

namespace App\Http\Controllers\Backup;

use App\Http\Controllers\Controller;
use App\Lib\SEO;
use App\Model\DonviModel;
use App\Model\ThuclucvukhichitietModel;
use App\Model\Xuatnhap\PhieunhapkhoModel;
use App\Model\Xuatnhap\PhieuxuatkhoModel;
use DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;


class BackUpController extends Controller
{
    /**
     * @return $this
     */
    public function index()
    {
        $is_backup = null;
        if (file_exists(storage_path() . '\app\dump\backup.sql')) {
            $is_backup = true;
        }
        return view('backup.index')->with('is_backup', $is_backup);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storage()
    {
        $date = date('d_m_Y_H_i_s');
        $environment = env('APP_ENV');

        if (file_exists(storage_path() . '\app\dump\backup.sql')) {
            if (rename(storage_path() . '\app\dump\backup.sql', storage_path() . '\app\dump\\' . $date . '_qlvk.sql')) {
                Artisan::call('db:backup', [
                    '--database' => 'mysql',
                    '--destination' => 'local',
                    '--destinationPath' => 'dump\backup.sql',
                    '--compression' => 'null',
                ]);
            };
        } else {
            Artisan::call('db:backup', [
                '--database' => 'mysql',
                '--destination' => 'local',
                '--destinationPath' => 'dump\backup.sql',
                '--compression' => 'null',
            ]);
        }
        return redirect()->route('backup.index')->with('flash_message_success', 'Đã tạo file backup thành công');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreIndex()
    {
        $is_backup = null;
        if (file_exists(storage_path() . '\app\dump\backup.sql')) {
            $is_backup = true;
        }
        return view('backup.restore')->with('is_backup', $is_backup);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore()
    {
        $is_backup = false;
        if (file_exists(storage_path() . '\app\dump\backup.sql')) {
            $is_backup = true;
            Artisan::call('db:restore', [
                '--source' => 'local',
                '--sourcePath' => 'dump\backup.sql',
                '--database' => 'mysql',
                '--compression' => 'null',
            ]);
            return redirect()->route('backup.restore')->with('is_backup', $is_backup)->with('flash_message_success', 'Đã restore thành công dữ liệu');
        }
        return redirect()->route('backup.restoreindex')->with('is_backup', $is_backup)->with('flash_message_error', 'Không tồn tại filebackup');
    }

}
