<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\QueryException;

use application\eloquents\Karyawan as Karyawan_model;

class Absensi extends CI_Controller {
	public function index()
	{
		$karyawan = Karyawan_model::with('absensis')->find(10);

		return blade('absensi.index', compact(['karyawan']));
	}
}
