<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $connection = 'mysql';
    protected $table = 'cities';

    public function states(){
        return $this->belongsTo('App\State', 'id_departamento');
    }
}
