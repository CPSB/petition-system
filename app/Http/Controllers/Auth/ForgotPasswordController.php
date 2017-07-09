<?php

namespace ActivismeBE\Http\Controllers\Auth;

use ActivismeBE\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

/**
 * Class ForgotPasswordController
 *
 * If you building a project don't edit this file. Because this file will be overwritten.
 * When we are updated our project skeleton. And if you found an issue in this controller
 * Use the following links.
 *
 * @url https://github.com/CPSB/Skeleton-project
 * @url https://github.com/CPSB/Skeleton-project/issues
 */
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
