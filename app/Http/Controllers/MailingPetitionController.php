<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\MailingAdresses;
use ActivismeBE\Petitions;
use ActivismeBE\Tokens;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * Class MailingPetitionController
 *
 * @package ActivismeBE\Http\Controllers
 */
class MailingPetitionController extends Controller
{
    private $petitions; /** @var Petitions       */
    private $tokens;    /** @var Tokens          */
    private $mailing;   /** @var MailingAdresses */

    /**
     * MailingPetitionController constructor.
     *
     * @param Petitions $petitions
     * @param Tokens    $token
     */
    public function __construct(MailingAdresses $mailing, Petitions $petitions, Tokens $token)
    {
        $this->middleware('lang');
        $this->middleware('auth');
        $this->middleware('role:Admin');

        $this->petitions = $petitions;
        $this->tokens    = $token;
        $this->mailing   = $mailing;
    }

    /**
     * Create view for the petition mailing.
     *
     * @param  Request $request
     * @return View|Request
     */
    public function create(Request $request)
    {
        try {
            $petition = $this->petitions->findOrFail($request->id);
            $token    = $this->tokens->where('token', '=', $request->token)
                ->where('section', '=', 'mailing-petition')
                ->where('created_at', '>', Carbon::now()->subMinutes(60)->toDateTimeString())
                ->count();

            if (! $petition->author_id === auth()->user()->id) {
                return app()->abort(403);
            }

            if ($token === 1) {
                $petitionId = $request->get('id');
                return view('petitions.create-mailing', compact('petitionId'));
            }

            flash('Wij konden niet verder gaan met het aanmaken van de mailing petitie.')->warning();
            return back(302);
        } catch (ModelNotFoundException $exception) {
            return app()->abort(404);
        }
    }

    /**
     * Store the mailing address in the system.
     *
     * @param  Request $input
     * @return void
     */
    public function store(Request $input)
    {
        $this->validate($input, ['email' => 'required']);

        try {
            $petition = $this->petitions->findOrFail($input->get('petition_id'));

            if ($mailing = $this->mailing->create($input->except(['_token', 'petition_id']))) {
                // Assign to the relation.
                $petition->update(['mailing_id' => $mailing->id]);

                flash('De aanmaak procedure voor de mailing petitie is compleet.');
                return redirect()->route('petitions.show', $input->get('petition_id'));
            }

            flash('De mailing petitie is aangemaakt.')->success();
        } catch (ModelNotFoundException $exception) {
            flash('Er is iets misgelopen.')->success();
            return back(302);
        }
    }
}
