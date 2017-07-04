<?php

namespace ActivismeBE;

use Illuminate\Database\Eloquent\Model;

class Signatures extends Model
{
    /**
     * Mass-assign fields for the database table.
     *
     * @var array
     */
    protected $fillable = ['country_id', 'postal_code', 'city', 'name', 'email', 'publish'];

    /**
     * Petition relation. used for connecting the signature to the petition.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function petition()
    {
        return $this->belongsToMany(Petitions::class)->withTimestamps();
    }

    /**
     * Country data relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_id');
    }
}
