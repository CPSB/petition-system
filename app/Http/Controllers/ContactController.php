<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Contact;
use ActivismeBE\User;
use ActivismeBE\Notifications\ContactMessage;
use ActivismeBE\Http\Requests\ContactValidator;
use Illuminate\Http\Request;

/**
 * Class ContactController
 *
 * If you building a project don't edit this file. Because this file will be overwritten.
 * When we are updated our project skeleton. And if you found an issue in this controller
 * Use the following links.
 *
 * @url https://github.com/CPSB/Skeleton-project
 * @url https://github.com/CPSB/Skeleton-project/issues
 */
class ContactController extends Controller
{
    private $messages;  /** @var Contact    $messages   The contact database model. */
    private $users;     /** @var User       $users      The user database model.    */

    /**
     * Create a new controller instance.
     *
     * @param Contact $messages
     * @param User    $users
     */
    public function __construct(Contact $messages, User $users)
    {
        $this->middleware('lang');

        $this->messages = $messages;
        $this->users    = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \ActivismeBE\Http\Requests\ContactValidator  $input
     * @return \Illuminate\Http\Response
     */
    public function store(ContactValidator $input)
    {
        if ($mail = $this->messages->create($input->except('_token'))) {
            $users = $this->users->role('Admin')->get();

            foreach ($users as $user) {
                $user->notify((new ContactMessage($mail)));
            }

            flash(trans('contact.contact-store'));
        }

        return back(302);
    }
}
