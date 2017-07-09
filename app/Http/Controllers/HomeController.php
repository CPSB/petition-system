<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Categories;
use ActivismeBE\Petitions;
use Illuminate\Http\Request;

/**
 * Class HomeController
 *
 * If you building a project don't edit these file. Because this file will be overwritten.
 * When we are updated our project skeleton. And if you found an issue in this controller
 * User the following links.
 *
 * @url https://github.com/CPSB/Skeleton-project
 * @url https://github.com/CPSB/Skeleton-project/issues
 */
class HomeController extends Controller
{
    private $categories;    /** @var Categories  */
    private $petitions;     /** @var Petitions   */

    /**
     * Create a new controller instance.
     *
     * @param Categories $categories
     * @param Petitions $petitions
     */
    public function __construct(Categories $categories, Petitions $petitions)
    {
        $this->middleware('banned')->only(['backend']);
        $this->middleware('auth')->only(['backend']);
        $this->middleware('lang');

        $this->categories = $categories;
        $this->petitions  = $petitions;
    }

    /**
     * The application front-page.
     *
     * @return void
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function backend()
    {
        return view('home');
    }
}
