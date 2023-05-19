<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    public function tier()
    {
        return $this->hasOne('App\Tier','id','tiers_id');
    }

    public function ligneVentes()
    {
        return $this->hasMany('App\LigneVente', 'vente_id', 'id');
    }

    public function operateur()
    {
        return $this->hasOne('App\User','id','emetteur_id');
    }
}
