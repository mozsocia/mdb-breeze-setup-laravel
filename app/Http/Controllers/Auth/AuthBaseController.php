<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;

trait AuthBaseController
{

    // auth guard defined in config auth
    public $guard = "web";

    // blade template folder in view folder
    public $view = "frontend.";

    // model
    public $model = User::class;

    // password broker defined in config.auth
    public $broker = 'users';

    public $home = '/dashboard';

}
