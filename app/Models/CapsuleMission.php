<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapsuleMission extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'capsule_mission';
    public $timestamps = false;
}
