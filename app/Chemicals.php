<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chemicals extends Model
{
    //
    protected $guarded = [];

    public function tocsin()
    {
      return $this->belongsTo(Tocsin::class);
    }

    public function package()
    {
      return $this->belongsTo(Package::class);
    }

    public function material()
    {
      return $this->belongsTo(Material::class);
    }

    public function unit()
    {
      return $this->belongsTo(Unit::class);
    }

    public function stock()
    {
      return $this->hasMany(Stock::class);
    }
}
