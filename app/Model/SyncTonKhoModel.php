<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SyncTonKhoModel extends Model
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'sync_tonkho';

    /**
     * These field that will fill data
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'donvi_id',
        'soluong',
        'phancap_id',
        'vukhi_id',
        'nuocsanxuat_id',
        'donvitinh_id',
        'code'];


    /**
     * Automate create timestamp
     *
     * @var bool
     */
    public $timestamps = true;


    public $primaryKey = 'id';
}
