<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Http\Requests\SignatureValidator;
use ActivismeBE\Petitions;
use ActivismeBE\Signatures;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * Class SignatureController
 *
 * @package ActivismeBE\Http\Controllers
 */
class SignatureController extends Controller
{
    private $signature; /** @var Signatures */
    private $petition;  /** @var Petitions  */

    /**
     * SignatureController constructor.
     *
     * @param Signatures $signature
     * @param Petitions  $petition
     */
    public function __construct(Signatures $signature, Petitions $petition)
    {
        $this->middleware('lang');

        $this->signature = $signature;
        $this->petition  = $petition;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $petition = $this->petition->where('author_id', auth()->user()->id)
                ->where('id', $request->petition)
                ->with(['categories', 'author', 'signatures.country'])
                ->firstOrFail();

            return view('signatures.index', compact('petition'));
        } catch (ModelNotFoundException $exception) {
            return app()->abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SignatureValidator $input
     * @return \Illuminate\Http\Response
     */
    public function store(SignatureValidator $input)
    {
        $filter   = $input->except(['_token', 'petition']);
        $database = $this->signature;

        if ($sign = $database->create($filter)) {
            $database->find($input->petition)->petition()->attach($sign->id);
            flash('Wij hebben uw handtekeningen verwerkt.')->success();
        }

        return back(302);
    }
}
