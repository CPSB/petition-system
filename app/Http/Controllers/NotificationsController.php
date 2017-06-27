<?php

namespace ActivismeBE\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

/**
 * Class NotificationsController
 *
 * If tour building a project don't edit these file. Because this file will be overwritten.
 * When we are updated our project skeleton. And if you found an issue in this controller
 * User the following links.
 *
 * @url https://github.com/CPSB/Skeleton-project
 * @url https://github.com/CPSB/Skeleton-project/issues
 */
class NotificationsController extends Controller
{
    /**
     * NotificationsController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('banned');
        $this->middleware('lang');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('notifications.index', compact('notifications'));
    }

    /**
     * Set one notifcation as read.
     *
     * @param  string $notificationId The id in the database for the notification.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markOne($notificationId)
    {
        try {
            $notification = DatabaseNotification::findOrFail($notificationId);

            if ($notification->update(['read_at' => Carbon::now()])) {
                flash('The notification has been read.');
            }

            return back(302);
        } catch (ModelNotFoundException $modelNotFoundException) {
            flash('We copuld not mark the notification with an read status')->error();
            return back(302);
        }
    }

    /**
     * Mark one notification as read.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAll()
    {
        if (auth()->user()->unreadNotifications->markAsRead()) {
            flash('All notifications as been read.')->success();
        }

        return back(302);
    }
}
