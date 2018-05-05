<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $table = 'clients';

    public function bonus() {
        return $this->hasOne('App\ClientBonus');
    }
}
