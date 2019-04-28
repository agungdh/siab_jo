<?php
namespace application\eloquents;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Karyawan extends Eloquent {
    protected $table = "karyawan";
    public $timestamps = false;

    public function absensis(){
    	return $this->hasMany('application\eloquents\Absensi', 'id_karyawan');
    }

    public function absensisToday(){
    	return $this->hasMany('application\eloquents\Absensi', 'id_karyawan')->whereRaw('day(waktu) = day(now())');
    }
}