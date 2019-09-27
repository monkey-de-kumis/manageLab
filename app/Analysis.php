<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analysis extends Model
{
    //
    protected $guarded = [];
    public function analysis_detail()
    {
      return $this->hasMany(Analysis_detail::class);
    }
}
