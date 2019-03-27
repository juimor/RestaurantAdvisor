<?php

namespace App\Model;

use App\Restaurants;
use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    protected $table = 'menus';

    public function restaurants ()
    {
        return $this->hasMany(Restaurants::class);
    }
}
