<?php
namespace application\eloquents;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Pegawai extends Eloquent {
    protected $table = "pegawai";
    public $timestamps = false;

    public function absensis(){
    	return $this->hasMany('application\eloquents\Absensi', 'id_pegawai')->whereNull('invalidated');
    }

    public function user(){
    	return $this->hasOne('application\eloquents\User', 'id_pegawai');
    }

    public function absensisToday(){
    	return $this->hasMany('application\eloquents\Absensi', 'id_pegawai')->whereRaw('date(waktu) = date(now())');
    }
   
    public function absensisTodayBerangkat(){
        return $this->hasOne('application\eloquents\Absensi', 'id_pegawai')->whereRaw('date(waktu) = date(now())')->where('tipe', 'b');
    }

    public function absensisTodayPulang(){
        return $this->hasOne('application\eloquents\Absensi', 'id_pegawai')->whereRaw('date(waktu) = date(now())')->where('tipe', 'p');
    }

    public function eselon(){
        return $this->belongsTo('application\eloquents\Eselon', 'id_eselon');
    }

    public function golongan(){
        return $this->belongsTo('application\eloquents\Golongan', 'id_golongan');
    }
}