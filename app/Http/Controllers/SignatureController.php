<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Http\Requests\SignatureValidator;
use Illuminate\Http\Request;

class SignatureController extends Controller
{
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
        dd($input->all());
    }
}
