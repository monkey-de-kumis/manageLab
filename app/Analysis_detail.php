<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analysis_detail extends Model
{
    //
    protected $guarded = [];

    public function analysis()
    {
      return $this->belongsTo(Analysis::class);
    }
}
