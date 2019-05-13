<?php
namespace application\eloquents;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent {
    protected $table = "user";
    public $timestamps = false;

   public function pegawai(){
    	return $this->belongsTo('application\eloquents\Pegawai', 'id_pegawai');
    }
}