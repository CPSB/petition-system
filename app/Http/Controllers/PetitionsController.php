<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Categories;
use ActivismeBE\Http\Requests\PetitionValidator;
use ActivismeBE\Petitions;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
     * Search for petitions.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {
        return view();
    }

    /**
     * Create view for a petition.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('petitions.create');
    }


    /**
     * Store a new petition in the system.
     *
     * @param  PetitionValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PetitionValidator $input)
    {
        $categories = explode(',', $input->categories); // Break up the text into an array

        // START Image upload
        $file  = $input->file('image');
        $path  = 'img/petitions/' .  time() . '.' . $file->getClientOriginalExtension();
        $image = Image::make($file);

        $image->fit(250, 250, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path)
        ;
        $input->merge(['author_id' => auth()->user()->id, 'image_path' => $path]);
        // END Image upload

        if ($petition = $this->petitions->create($input->except(['_token', 'categories']))) {
            foreach ($categories as $category) {
                $insert = $this->categories->firstOrCreate(['name' => trim($category), 'module' => 'petition']);
                $this->petitions->find($petition->id)->categories()->attach($insert->id);
            }
        }
        return redirect()->route('petitions.show', $petition);
    }

    /**
     * Show a specific petition.
     *
     * @param   integer $id The petition in the database.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id)
    {
        try {
            $petition = $this->petitions->findorFail($id);

            return view('petitions.show', compact('petition'));
        } catch (ModelNotFoundException $modelNotFoundException) {
            return back(302);
        }
    }

    public function destroy($id)
    {
        try {
            $petition = $this->petitions->findOrFail($id);

            if ($petition->delete()) {
                flash('De petitie is verwijderd');
            }

            return redirect()->route('petitions.index');
        } catch (ModelNotFoundException $modelNotFoundException) {
            dd('meh');
            return back(302);
        }
    }
}
