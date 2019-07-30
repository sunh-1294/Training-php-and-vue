<?php

namespace App\Models;

use App\Models\User;
use App\Models\Group;
use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{

    protected $table='group_user';

    protected $fillable = [
        'user_id',
        'group_id',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function group()
    {
        return $this->hasOne(Group::class);
    }
}
