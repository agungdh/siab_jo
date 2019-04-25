<?php
namespace application\eloquents;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Barang extends Eloquent {
    protected $table = "barang";
    public $timestamps = false;

    public function orang(){
    	return $this->belongsTo('application\eloquents\Orang', 'id_orang');
    }
}