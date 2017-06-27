<?php

namespace ActivismeBE;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Categories
 *
 * @package ActivismeBE
 */
class Categories extends Model
{
    /**
     * Mass-assign fields for the database.
     *
     * @var array
     */
    protected $fillable = ['module', 'name', 'description'];
}
