<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\User;
use Illuminate\Http\Request;

/**
 * Class AccountSettingsController
 *
 * If you building a project don't edit this file. Because this file will be overwritten.
 * When we are updated our project skeleton. And if you found an issue in this controller
 * Use the following links.
 *
 * @url https://github.com/CPSB/Skeleton-project
 * @url https://github.com/CPSB/Skeleton-project/issues
 */
class AccountSettingsController extends Controller
{
    /**
     * Account Settings constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('banned');
        $this->middleware('lang');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findOrFail(auth()->user()->id);
        return view('auth.settings', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateInfo(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        if (User::findOrFail(auth()->user()->id)->update($request->all())) {
            flash(trans('profile-settings.flash-info'))->success();
        }

        return back(302);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateSecurity(Request $request)
    {
        $this->validate($request, ['password' => 'required|string|min:6|confirmed']);

        if (User::findOrFail(auth()->user()->id)->update(bcrypt($request->all()))) {
            flash(trans('profile-settings.flash-password'))->success();
        }

        return back(302);
    }
}
