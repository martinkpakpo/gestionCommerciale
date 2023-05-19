<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Approvisionnement extends Model
{
    public function tier()
    {
        return $this->hasOne('App\Tier','id','tiers_id');
    }

    public function ligneApprovisionnements()
    {
        return $this->hasMany('App\LigneApprovisionnement', 'approvisionnement_id', 'id');
    }

    public function operateur()
    {
        return $this->hasOne('App\User','id','emetteur_id');
    }

    public function timeline()
    {
        return $this->hasMany('App\TimelineApprovisionnement', 'approvisionnement_id', 'id');
    }

    public function livraison()
    {
        return $this->hasMany('App\LivraisonApprovisionnement','approvisionnement_id', 'id');
    }
}
