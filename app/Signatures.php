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
}
