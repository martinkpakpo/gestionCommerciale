<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demarque extends Model
{
    public function produit()
    {
        return $this->hasOne('App\Produit','id','produit_id');
    }
}
