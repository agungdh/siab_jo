<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
use application\eloquents\Absensi as Absensi_model;
use application\eloquents\Karyawan as Karyawan_model;

class Riwayatabsensi extends CI_Controller {

	public function index()
	{	
		$karyawans = Karyawan_model::all();

		return blade('riwayatabsensi.index', compact(['karyawans']));
	}

	public function getDataAbsensi($id_karyawan = "0", $tanggal = "0", $sampai = "0")
	{
		$datas = new Absensi_model();

		if ($id_karyawan != '0') {
			$datas = $datas->where('id_karyawan', $id_karyawan);
		}

		if ($tanggal != '0' && $sampai != '0') {
			$tanggal = helper()->parseTanggalIndo($tanggal);
			$sampai = helper()->parseTanggalIndo($sampai);

			$datas = $datas->whereRaw('date(waktu) >= CAST(? AS DATE)', $tanggal);
			$datas = $datas->whereRaw('date(waktu) <= CAST(? AS DATE)', $sampai);
		} elseif ($tanggal != '0') {
			$tanggal = helper()->parseTanggalIndo($tanggal);

			$datas = $datas->whereRaw('date(waktu) = ?', $tanggal);
		}

		// echo $datas->toSql(); die;

		$datas = $datas->get();
		dd($datas);

		dd(compact(['id_karyawan', 'tanggal', 'sampai']));
	}
}
