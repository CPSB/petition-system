<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Traits\SignaturesTrait;
use ActivismeBE\Petitions;
use Illuminate\Http\Request;

/**
 * Class ExportController
 *
 * @package ActivismeBE\Http\Controllers
 */
class ExportController extends Controller
{
    use SignaturesTrait;

    private $petition; /** @var Petitions */

    /**
     * ExportController constructor.
     *
     * @param Petitions $petition
     */
    public function __construct(Petitions $petition)
    {
        $this->middleware('lang');
        $this->middleware('auth');
        $this->middleware('banned');

        $this->petition = $petition;
    }

    /**
     * Export the signatures from the database to some file.
     *
     * @param  string  $type        The type from the desired file. (xls, pdf)
     * @param  integer $petitionId  The id form the petition in the database.
     * @return mixed
     */
    public function export(string $type, int $petitionId)
    {
        $this->downloadSignature($type, $petitionId);
    }
}
