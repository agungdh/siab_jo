<?php
namespace application\eloquents;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class IjinAbsensi extends Eloquent {
    protected $table = "ijin_absensi";
    public $timestamps = false;

    public function pegawai(){
        return $this->belongsTo('application\eloquents\Pegawai', 'id_pegawai');
    }
}