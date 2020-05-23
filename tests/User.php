<?php

namespace A1tem\KnowledgeBase\Tests;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 *
 * @package A1tem\KnowledgeBase\Tests
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class User extends Model implements AuthorizableContract, AuthenticatableContract
{
    use Authorizable, Authenticatable, HasApiTokens;

    protected $guarded = [];

    protected $table = 'users';
}
