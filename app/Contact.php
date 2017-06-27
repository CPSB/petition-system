<?php

namespace ActivismeBE;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * Mass-assign fields for the database table.
     * 
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'message', 'subject'];
}
