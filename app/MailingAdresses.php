<?php

namespace ActivismeBE;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MailingAdresses
 *
 * @package ActivismeBE
 */
class MailingAdresses extends Model
{
    /**
     * Mass-assgin fields for the database.
     *
     * @var array
     */
    protected $fillable = ['email'];
}
