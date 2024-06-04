<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\RoleDetail;

class Role extends Authenticatable
{
    protected $table = "role";
    protected $guarded = ['id'];

    public function roledetail()
    {
        return $this->hasMany(RoleDetail::class);
    }
}
