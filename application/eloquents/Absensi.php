<?php
namespace application\eloquents;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Absensi extends Eloquent {
    protected $table = "absensi";
    public $timestamps = false;

    public function pegawai(){
    	return $this->belongsTo('application\eloquents\Pegawai', 'id_pegawai');
    }
}