<?php

namespace Aboleon\Framework\Models;

use Aboleon\Framework\Traits\Users;

class User extends \App\Models\User
{
    use Users;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];


}
