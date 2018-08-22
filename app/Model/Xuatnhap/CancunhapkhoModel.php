<?php

namespace App\Model\Xuatnhap;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CancunhapkhoModel
 *
 * @property int cancunhapkho_id
 * @property string cancunhapkho_name
 * @property string cancunhapkho_cqralenh
 * @property string cancunhapkho_code
 * @property string cancunhapkho_number
 * @property Date cancunhapkho_date
 * @property string cancunhapkho_note
 * @property int cancunhapkho_active
 *
 * @package App\Model\Xuatnhap
 */
class CancunhapkhoModel extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'cancunhapkho';

    /**
     * Specify these fields that will be fill data
     *
     * @var array
     */
    protected $fillable = [
        'cancunhapkho_name',
        'cancunhapkho_coquan',
        'cancunhapkho_code',
        'cancunhapkho_number',
        'cancunhapkho_date',
        'cancunhapkho_note',
        'cancunhapkho_active'
    ];

    /**
     * Specify primary key
     *
     * @var string
     */
    public $primaryKey = 'cancunhapkho_id';

    /**
     * Disabled mode auto create timestamp
     *
     * @var bool
     */
    public $timestamps = false;
}
