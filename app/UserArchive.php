<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserArchive extends Model
{
    use SoftDeletes;

    protected $table = "users";
}
