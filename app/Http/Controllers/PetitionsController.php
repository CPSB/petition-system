<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Categories;
use ActivismeBE\Countries;
use ActivismeBE\Http\Requests\PetitionValidator;
use ActivismeBE\Petitions;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
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
    private $countries;  /** @var Countries  */

    /**
     * PetitionsController constructor.
     *
     * @param Petitions  $petitions
     * @param Categories $categories
     * @param Countries  $countries
     */
    public function __construct(Petitions $petitions, Categories $categories, Countries $countries)
    {
        $routes = ['create', 'store'];

        $this->middleware('lang');
        $this->middleware('auth')->only($routes);

        $this->petitions  = $petitions;
        $this->categories = $categories;
        $this->countries  = $countries;
    }

    /**
     * Search for petitions.
     *
     * @param  Request $input
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $input)
    {
        $this->validate($input, ['term' => 'required']);

        $categories = $this->categories->where('module', 'petition')->take(15)->get();
        $petitions  = $this->petitions
            ->with(['author', 'categories', 'signatures'])
            ->where('title', 'LIKE', "%{$input->term}%")
            ->paginate(10);

        return view('welcome', compact('categories', 'petitions'));
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
        })->save($path);

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
            $petition  = $this->petitions->findorFail($id);
            $countries = $this->countries->all();

            return view('petitions.show', compact('petition', 'countries'));
        } catch (ModelNotFoundException $modelNotFoundException) {
            return back(302);
        }
    }

    /**
     * Delete a petition in the system.
     *
     * @todo: Create unassign method for the signatures.
     *
     * @param  integer $id The id from the petition in the database.
     * @return mixed
     */
    public function destroy($id)
    {
        try {
            $petition = $this->petitions->findOrFail($id);

            if ($petition->delete()) { // Petition has been deleted.
                if ($photo = file_exists(public_path($petition->image_path))) { unlink($photo); }

                $petition->categories()->sync([]); // Unassign categories from the petition in the pivot table.

                // Output handling
                flash('De petitie is verwijderd');
            }

            return redirect()->route('index');
        } catch (ModelNotFoundException $modelNotFoundException) {
            return back(302);
        }
    }
}
