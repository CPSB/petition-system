<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Categories;
use ActivismeBE\User;
use ActivismeBE\Helpdesk;
use ActivismeBE\Notifications\NewSupportQuestion;
use ActivismeBE\Http\Requests\HelpdeskQuestionValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class HelpDeskController extends Controller
{
    private $tickets;     /** @var Helpdesk   */
    private $users;       /** @var User       */
    private $categories;  /** @var Categories */

    /**
     * HelpDeskController constructor.
     *
     * @param Helpdesk      $tickets
     * @param User          $users
     * @param Categories    $categories
     */
    public function __construct(Helpdesk $tickets, User $users, Categories $categories)
    {
        $this->middleware('lang');
        $this->middleware('auth');

        $this->tickets    = $tickets;
        $this->users      = $users;
        $this->categories = $categories;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->check() && auth()->user()->hasRole('Admin')) {
            // Check if the user is authencated. And has the admin role. 
            // IF user has the admin role. Show the admin panel for the helpdesk. 
            
            return view('helpdesk.admin');
        } 

        $all     = $this->tickets->count();
        $open    = $this->tickets->where('open', 'Y')->count();
        $closed  = '';

        return view('helpdesk.index', compact('all', 'open', 'closed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categories
            ->where('module', 'helpdesk-categories')->get();

        return view('helpdesk.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param HelpdeskQuestionValidator     $input
     * @return \Illuminate\Http\Response
     */
    public function store(HelpdeskQuestionValidator $input)
    {
        if ((int) auth()->user()->id == $input->author_id) {
            $input->merge(['open' => 'Y']);
            $question = $this->tickets->create($input->except('_token'));

            // Notify the admins.
            $admins = $this->users->role('Admin')->get();

            foreach ($admins as $admin) {
                $admin->notify(new NewSupportQuestion($question)); // Notify some admin.
            }

            flash('Wij hebben u vraag goed ontvangen. Wij antwoorden spoedig.');
            return back(302);
        }

        flash('Wij konden je vraag niet verwerken.')->error();

        return back(302);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $question = $this->tickets->findOrFail($id);

            return view('helpdesk.show', compact('question'));
        } catch (ModelNotFoundException $modelNotFoundException) {
            return back(302);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Get the helpdesk questions for a user.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUser()
    {
        $questions = $this->tickets->where('author_id', auth()->user()->id)
            ->with(['categories', 'author', 'comments'])
            ->paginate(25);

        return view('helpdesk.user', compact('questions'));
    }

    /**
     * Get the public helpdesk tickets.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPublic()
    {
        $questions = $this->tickets->where('publish', 'Y')
            ->with(['categories', 'author', 'comments'])
            ->paginate(25);

        return view('helpdesk.user', compact('questions'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id The helpdesk question id in the database.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
