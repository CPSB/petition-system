<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\User;
use ActivismeBE\Role;
use ActivismeBE\Permission;
use ActivismeBE\Traits\Authorizable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * Class UserController
 *
 * If tour building a project don't edit these file. Because this file will be overwritten.
 * When we are updated our project skeleton. And if you found an issue in this controller
 * User the following links.
 *
 * @url https://github.com/CPSB/Skeleton-project
 * @url https://github.com/CPSB/Skeleton-project/issues
 */
class UserController extends Controller
{
    use Authorizable;

    private $users; /** @var User $user The users model in the database. */

    /**
     * Create a new controller instance.
     *
     * @param User $users
     */
    public function __construct(User $users)
    {
        $this->middleware('banned');
        $this->middleware('lang');

        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $input)
    {
        if (empty($input->get('term'))) {
            $result = User::latest()->paginate(15);
        } else {
            $result = User::latest()
                ->where('name', 'LIKE', '%'. $input->get('term') .'%')
                ->paginate(15);
        }

        return view('user.index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id');
        return view('user.new', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'bail|required|min:2',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:6',
            'roles'     => 'required|min:1'
        ]);

        $request->merge(['password' => bcrypt($request->get('password'))]); // Hash password.

        // Create user
        if ($user = User::create($request->except('roles', 'permissions'))) {
            $this->syncPermissions($request, $user);
            flash('User has been created');
        } else {
            flash()->error('Unable to create the user.');
        }

        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user        = User::find($id);
        $roles       = Role::pluck('name', 'id');
        $permissions = Permission::all('name', 'id');

        return view('user.edit', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'  => 'bail|required|min:2',
            'email' => 'required|email|unique:users,email,' . $id,
            'roles' => 'required|min:1'
        ]);

        // Get the user
        $user = User::findOrFail($id);

        // Update user
        $user->fill($request->except('roles', 'permissions', 'password'));

        if ($request->get('password')) { // Check for password change
            $user->password = bcrypt($request->get('password'));
        }

        // Handle the user roles.
        $this->syncPermissions($request, $user);
        $user->save();

        flash()->success('User has been updated.');
        return redirect()->route('users.index');
    }

    /**
     * Block a user in the system.
     *
     * @param  Integer  $userId  The user id in the database.
     * @return mixed
     */
    public function block($userId)
    {
        try {
            // TODO: Register route
            $user = $this->users->findOrFail($userId);

            if (auth()->user()->can('edit_users') && auth()->user()->can('edit_roles')) {
                if ($user->ban(['comment' => '+1 week'])) {
                    flash("{$user->name} has been banned.")->success();

                    return back(302);
                }
            }

            return app()->abort(403);
        } catch(ModelNotFoundException $modelNotFoundException) {
            return app()->abort(404);
        }
    }

    /**
     * Unblock a user.
     *
     * @param  integer $userId  The user id in the database.
     * @return mixed
     */
    public function unblock($userId)
    {
        try {
            $user = $this->users->findOrFail($userId);

            if (auth()->user()->can('edit_users') && auth()->user()->can('edit_roles')) {
                if ($user->isBanned()) {
                    $user->unban();
                    flash("{$user->name} is back active.")->success();
                }
            }

            return redirect()->route('users.index');
        } catch(ModelNotFoundException $exception) {
            return app()->abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->id == $id) {
            flash()->warning('Deletion of currently logged in user is not allowed.')->important();
            return redirect()->back();
        }

        if (User::findOrFail($id)->delete()) {
            flash()->success('User has been deleted.');
        } else {
            flash()->success('user not deleted.');
        }

        return redirect()->back();
    }

    private function syncPermissions(Request $request, $user)
    {
        // Get the submitted roles.
        $roles       = $request->get('roles', []);
        $permissions = $request->get('permissions', []);

        // Get the roles
        $roles = Role::find($roles);

        // check for current role changes.
        if (! $user->hasAllRoles($roles)) { // Reset all direct permissions for user.
            $user->permissions()->sync([]);
        } else { // Handle permissions
            $user->syncPermissions($permissions);
        }

        $user->syncRoles($roles);
        return $user;
    }
}
