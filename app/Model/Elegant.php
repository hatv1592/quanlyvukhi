<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Elegant extends Model
{

    protected $rules = array();
    protected $errors;
    public $timestamps = false;

    public function validate($data)
    {
        // make a new validator object
        $v = Validator::make($data, $this->rules);

        // check for failure
        if ($v->fails()) {
            // set errors and return false
            $this->errors = $v->errors;
            return false;
        }

        // validation pass
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }

}