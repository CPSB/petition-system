<?php

namespace ActivismeBE;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tokens
 *
 * @package ActivismeBE
 */
class Tokens extends Model
{
    /**
     * Mass-assign fields for the database columns.
     *
     * @var array
     */
    protected $fillable = ['section', 'token'];
}
