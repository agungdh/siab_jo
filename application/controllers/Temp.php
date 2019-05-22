<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
use application\eloquents\HariLibur as HariLibur_model;
use application\eloquents\Pegawai as Pegawai_model;
use application\eloquents\Absensi as Absensi_model;

class Temp extends CI_Controller {
	public function index()
	{
		$datas = HariLibur_model::whereRaw('year(tanggal) in (?,?,?)', [date('Y') - 1, date('Y'), date('Y') + 1])->get();

		dd($datas);
	}

	public function reportbulanan()
	{
		$bulan = 5;
		$tahun = 2019;
		$idPegawai = 1;

		$pegawais = Pegawai_model::with([
			'golongan', 
			'eselon',
		])->get();
		
		return blade('dashboard.absenbulanan', compact(['pegawais', 'bulan', 'tahun']));
	}
}
