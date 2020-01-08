<?php

namespace App\Http\Controllers;

class MetaHelper
{
    private $_data = [];
    private $_status = 200;

    public function __construct($data)
    {
        $this->_data = $data;
        return $this;
    }/**/

    public function setMeta($meta = [])
    {
        $this->_data =  array_merge([
            'meta' => $meta
        ],$this->_data);
        return $this;
    }

    public function setStatus($status = 200)
    {
        $this->_status = $status;
        return $this;
    }

    public function json() {
        return response()->json($this->_data, $this->_status);
    }

}
