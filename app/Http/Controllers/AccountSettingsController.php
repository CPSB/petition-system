<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Countries;
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
    private $users; /** @var User */

    /**
     * Account Settings constructor
     *
     * @param User $users
     */
    public function __construct(User $users)
    {
        $this->middleware('auth');
        $this->middleware('banned');
        $this->middleware('lang');

        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user      = $this->users->findOrFail(auth()->user()->id);
        $countries = Countries::all();

        return view('auth.settings', compact('user', 'countries'));
    }

    /**
     * Return a user profile in the application.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($userId)
    {
        if ($userId == auth()->user()->id) { // The user u want to display is the authencated user.
            return view();
        } else {
            return view();
        }
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
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'postal_code'   => 'required|string|max:255',
            'city'          => 'required|string',
            'country'       => 'required|max:10|integer',
        ]);

        $request->merge(['name' => "{$request->first_name} {$request->last_name}"]);

        if ($this->users->findOrFail(auth()->user()->id)->update($request->all())) {
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

        if ($this->users->findOrFail(auth()->user()->id)->update(['password' => bcrypt($request->password)])) {
            flash(trans('profile-settings.flash-password'))->success();
        }

        return back(302);
    }
}
