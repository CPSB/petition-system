<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Http\Requests\SignatureValidator;
use ActivismeBE\Petitions;
use ActivismeBE\Signatures;
use Illuminate\Http\Request;

/**
 * Class SignatureController
 *
 * @package ActivismeBE\Http\Controllers
 */
class SignatureController extends Controller
{
    private $signature; /** @var Signatures */

    /**
     * SignatureController constructor.
     *
     * @param Signatures $signature
     */
    public function __construct(Signatures $signature)
    {
        $this->middleware('lang');

        $this->signature = $signature;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view();
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
            $this->signature->find($input->petition)->petition()->attach($sign->id);
            flash('Wij hebben uw handtekeningen verwerkt.')->success();
        }

        return back(302);
    }
}
