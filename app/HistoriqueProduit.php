<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoriqueProduit extends Model
{
    public function produit()
    {
        return $this->hasOne('App\Produit','id','produit_id');
    }
}
