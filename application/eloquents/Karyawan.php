<?php
namespace application\eloquents;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Karyawan extends Eloquent {
    protected $table = "karyawan";
    public $timestamps = false;
}