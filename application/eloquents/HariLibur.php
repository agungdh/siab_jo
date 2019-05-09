<?php
namespace application\eloquents;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class HariLibur extends Eloquent {
    protected $table = "hari_libur";
    public $timestamps = false;
}