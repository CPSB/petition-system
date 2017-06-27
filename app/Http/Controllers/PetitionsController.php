<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Categories;
use ActivismeBE\Http\Requests\PetitionValidator;
use ActivismeBE\Petitions;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * Class PetitionsController
 *
 * @package ActivismeBE\Http\Controllers
 */
class PetitionsController extends Controller
{
    private $petitions;  /** @var Petitions  */
    private $categories; /** #var Categories */

    /**
     * PetitionsController constructor.
     *
     * @param Petitions  $petitions
     * @param Categories $categories
     */
    public function __construct(Petitions $petitions, Categories $categories)
    {
        $routes = ['create', 'store'];

        $this->middleware('lang');
        $this->middleware('auth')->only($routes);

        $this->petitions  = $petitions;
        $this->categories = $categories;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {
        return view();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('petitions.create');
    }


    /**
     * @param  PetitionValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PetitionValidator $input)
    {
        $categories = explode(',', $input->categories); // Break up the text into an array
        $input->merge(['author_id' => auth()->user()->id]);


        if ($petition = $this->petitions->create($input->except(['_token', 'categories']))) {
            foreach ($categories as $category) {
                $insert = $this->categories->firstOrCreate(['name' => trim($category), 'module' => 'petition']);
                $this->petitions->find($petition->id)->categories()->attach($insert->id);
            }
        }
        return redirect()->route('petition.show', $petition);
    }

    /**
     * @param   integer $id The petition in the database.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id)
    {
        try {
            $petition = $this->petitions->findorFail($id);

            return view('petition.show', compact('petition'));
        } catch (ModelNotFoundException $modelNotFoundException) {
            return back(302);
        }
    }
}
