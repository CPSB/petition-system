<?php

namespace ActivismeBE;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comments
 *
 * @package ActivismeBE
 */
class Comments extends Model
{
    /**
     * Mass-assign fields for the database table.
     *
     * @var array
     */
    protected $fillable = ['comment', 'author_id'];

    /**
     * Get the author information for the comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Support question data relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function supportQuestion()
    {
        return $this->belongsToMany(Helpdesk::class)->withTimestamps();
    }
}
