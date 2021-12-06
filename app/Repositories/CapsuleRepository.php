<?php

namespace App\Repositories;

use App\Models\Capsule;

class CapsuleRepository
{
    protected $capsule;

    public function __construct(Capsule $capsule)
    {
        $this->capsule = $capsule;
    }

    public function get_by_filters($filters = []){
        $capsule = Capsule::query();
        foreach ($filters as $k => $v)
            $capsule->where($k, $v);
        return $capsule->get();
    }

    public function get_by_name($capsule_serial){
        return Capsule::with('missions')->where('serial_code', $capsule_serial)->first();
    }

}
