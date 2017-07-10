<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Comments;
use ActivismeBE\Helpdesk;
use ActivismeBE\Notifications\NewComment;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * Class CommentsController
 *
 * @package ActivismeBE\Http\Controllers
 */
class CommentsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $input
     * @return \Illuminate\Http\Response
     */
    public function store(Request $input)
    {
        $this->validate($input, ['comment' => 'required']);

        $question = Helpdesk::findOrfail($input->question_id);
        $input->merge(['author_id', auth()->user()->id]);

        if ($comment = Comments::create($input->except(['_token', 'question_id']))) {
            $question->comments()->attach($comment->id);
            $participators = $question->author()->distinct()->get(['id']);

            foreach ($participators as $participator) {
                if ((int) $input->author_id !== auth()->user()->id) {
                    $participator->notify(new NewComment($input));
                }
            }

            flash('Uw reactie is opgeslagen');
            return redirect()->route('helpdesk.show', ['id' => $input->question_id]);
        }
    }

    public function destroy($commentId)
    {
        try {
            $comment = Comments::findOrFail($commentId);

            if ((string) auth()->user()->id == $comment->author_id or auth()->user()->hasRole('Admin')) {
                $comment->supportQuestion()->sync([]);
                $comment->delete();

                flash('De reactie is verwijderd');
            }

            return back(302);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return back(302);
        }
    }
}
