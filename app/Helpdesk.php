<?php

namespace ActivismeBE;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Helpdesk
 *
 * @package ActivismeBE
 */
class Helpdesk extends Model
{
    /**
     * Mass-assign fields for the database.
     *
     * @var array
     */
    protected $fillable = ['author_id', 'publish', 'description', 'title', 'category_id', 'open'];

    /**
     * The question author relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Category relation for the questions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categories()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    /**
     * Get the comments for a question.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function comments()
    {
        return $this->belongsToMany(Comments::class)->withTimestamps();
    }
}
