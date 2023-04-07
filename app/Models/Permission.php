<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;

    protected $fillable= ['module_id','name','slug'];

    public function roles()
    {
        return $this->belongsToMany(Role::class); // permission er under a roll ana holo
    }

}
