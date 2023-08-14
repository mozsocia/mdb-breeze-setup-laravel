<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\User;

trait AuthBaseController
{

    // auth guard defined in config auth
    public $guard = "web";

    public $name_prefix  = "admin."; // use route name group prefix here

    // blade template folder in view folder
    public $view = "admin.";

    // model
    public $model = User::class;

    // password broker defined in config.auth
    public $broker = 'users';

    public $home = '/dashboard';

}
