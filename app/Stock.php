<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    //
    public function chemicals()
    {
      return $this->belongsTo(Chemicals::class);
    }
}
