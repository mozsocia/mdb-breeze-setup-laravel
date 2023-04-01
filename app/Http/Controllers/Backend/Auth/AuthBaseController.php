<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Models\Admin;

trait AuthBaseController
{

    // auth guard defined in config auth
    public $guard = "admin";

    // blade template folder in view folder
    public $view = "backend.";

    // model
    public $model = Admin::class;

    // password broker defined in config.auth
    public $broker = 'admins';

    public $home = 'admin/dashboard';

}
