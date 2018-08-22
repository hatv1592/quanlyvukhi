<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SoPhieuModel extends Model
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'sophieu';

    /**
     * These field that will fill data
     *
     * @var array
     */
    protected $fillable = ['sophieu_key', 'sophieu_year', 'sophieu_stt'];

    /**
     * Disabled automate create timestamp
     *
     * @var bool
     */
    public $timestamps = false;


    public $primaryKey = 'sophieu_key';

}
