<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
use application\eloquents\HariLibur as HariLibur_model;
use application\eloquents\Pegawai as Pegawai_model;
use PHPJasper\PHPJasper;

class Temp extends CI_Controller {
	public function index()
	{
		$datas = HariLibur_model::whereRaw('year(tanggal) in (?,?,?)', [date('Y') - 1, date('Y'), date('Y') + 1])->get();

		dd($datas);
	}

	public function reportbulanan()
	{
		// $waktuPulang = str_replace(':', '', env('WAKTU_PULANG'));
		// dd([
		// 	abs(
		// 		(int)str_replace(':', '', env('WAKTU_PULANG'))
		// 		- 
		// 		(int)str_replace(':', '', env('WAKTU_BERANGKAT'))
		// 	)
		// ]);
		dd(abs(helper()->convertJamMenitKeMenit('08:00') - helper()->convertJamMenitKeMenit('16:00')));
		$bulan = 5;
		$tahun = 2019;
		$pegawais = Pegawai_model::with([
			'golongan', 
			'eselon',
		])->get();
		
		return blade('dashboard.absenbulanan', compact(['pegawais', 'bulan', 'tahun']));
	}
}
