<?php

namespace App\Services;

use App\Models\Capsule;
use App\Repositories\CapsuleRepository;

class CapsuleService
{
    protected $capsule_repository;

    public function __construct(CapsuleRepository $capsule_repository)
    {
        $this->capsule_repository = $capsule_repository;
    }

    public function get_capsules_by_filters($filters = []){
        return $this->capsule_repository->get_by_filters($filters);
    }

    public function get_capsule_by_name($capsule_serial){
        return $this->capsule_repository->get_by_name($capsule_serial);
    }
}
