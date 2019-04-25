<?php
namespace application\eloquents;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Orang extends Eloquent {
    protected $table = "orang";
    public $timestamps = false;

    public function barangs(){
    	return $this->hasMany('application\eloquents\Barang', 'id_orang');
    }
}