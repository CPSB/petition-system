<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Contact;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * Class ContactBackendController
 *
 * If you building a project don't edit this file. Because this file will be overwritten.
 * When we are updated our project skeleton. And if you found an issue in this controller
 * Use the following links.
 *
 * @url https://github.com/CPSB/Skeleton-project
 * @url https://github.com/CPSB/Skeleton-project/issues
 */
class ContactBackendController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('lang');
        $this->middleware('banned');
        $this->middleware('role:Admin,access_contact');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unreads = new Contact;
        return view('contact.backend-index', compact('unreads'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $message = Contact::findOrFail($id);

            if ($message->is_read === 'N') {
                $message->update(['is_read' => 'Y', 'read_by' => auth()->user()->id]);
            }

            return view('contact.show', compact('message'));
        } catch (ModelNotFoundException $modelNotFoundException) {
            return app()->abort(302);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $message = Contact::firstOrFail($id);

            if ($message->delete()) {
                flash('The contact message has been deleted.')->success();
            }

            return back(302);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return app()->abort(302);
        }
    }
}
