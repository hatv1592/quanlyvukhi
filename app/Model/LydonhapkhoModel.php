<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LydonhapkhoModel extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'lydonhapkho';

    /**
     * Disabled the mode auto create timestamp
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Set primary key
     *
     * @var string
     */
    public $primaryKey = 'lydonhapkho_id';
}
