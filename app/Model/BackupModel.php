<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BackupModel
 *
 * @property int nhomvukhi_id
 * @property int covukhi_id
 * @property int covukhi_code
 * @property int covukhi_name
 * @property int covukhi_active
 *
 *
 * @package App\Model
 */
class BackupModel extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'backup';

    /**
     * These field that will fill data
     *
     * @var array
     */
    protected $fillable = ['id', 'path', 'name'];

    /**
     * Disabled the automate create timestamp
     *
     * @var bool
     */
    public $timestamps = true;
}
