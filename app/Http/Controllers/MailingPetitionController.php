<?php

namespace ActivismeBE\Http\Controllers;

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
    private $petitions; /** @var Petitions */
    private $tokens;    /** @var Tokens    */

    /**
     * MailingPetitionController constructor.
     *
     * @param Petitions $petitions
     * @param Tokens    $token
     */
    public function __construct(Petitions $petitions, Tokens $token)
    {
        $this->middleware('lang');
        $this->middleware('auth');
        $this->middleware('role:Admin');

        $this->petitions = $petitions;
        $this->tokens     = $token;
    }

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
                return view('petitions.create-mailing');
            }

            flash('Wij konden niet verder gaan met het aanmaken van de mailing petitie.')->warning();
            return back(302);
        } catch (ModelNotFoundException $exception) {
            return app()->abort(404);
        }
    }

    public function store()
    {

    }
}
