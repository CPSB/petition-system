<?php

namespace ActivismeBE;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Countries
 *
 * @package ActivismeBE
 */
class Countries extends Model
{
    /**
     * Mass-assign fields for the database table.
     *
     * @var array
     */
    protected $fillable = ['short_name', 'long_name'];
}
