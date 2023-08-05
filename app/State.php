<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
  protected $connection = 'mysql';
  protected $table = 'states';

  public function cities() {
		return $this->hasMany('App\City','id_departamento');
	}
}
