<?php

namespace ActivismeBE;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Petitions
 *
 * @package ActivismeBE
 */
class Petitions extends Model
{
    /**
     * Mass-assign fields for the database table.
     *
     * @var array
     */
    protected $fillable = ['title', 'image_path', 'text', 'author_id', 'total_signatures', 'type', 'mailing_id'];

    /**
     * Petition categories data relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Categories::class)->withTimestamps();
    }

    /**
     * Author data relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Petition signatures data relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function signatures()
    {
        return $this->belongsToMany(Signatures::class)->withTimestamps();
    }

    /**
     * Mailing petition data relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function mailing()
    {
        return $this->belongsTo(MailingAdresses::class, 'mailing_id');
    }
}
