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

		$tempHariLiburs = DB::select('SELECT tanggal
					                        FROM hari_libur
					                        WHERE MONTH(tanggal) = ?
											AND YEAR(tanggal) = ?', [$bulan, $tahun]);
		$hariLiburs = [];
		foreach ($tempHariLiburs as $item) {
			$hariLiburs[] = $item->tanggal;
		}
		unset($tempHariLiburs);

		$tempSemuaTanggalPadaBulanTahun = helper()->semuaTanggalPadaBulanTahun($bulan, $tahun);
		$semuaTanggalPadaBulanTahun = [];
		foreach ($tempSemuaTanggalPadaBulanTahun as $item) {
			$numDay = date('N', strtotime($item->date_field));

			if ($numDay != 6 && $numDay != 7 && !in_array($item->date_field, $hariLiburs)) {
				$semuaTanggalPadaBulanTahun[] = $item->date_field;
			}
		}
		unset($tempSemuaTanggalPadaBulanTahun);

		dd(compact(['semuaTanggalPadaBulanTahun', 'hariLiburs']));

		// $tanggalAbsens = DB::select('SELECT DISTINCT(DATE(waktu)) tanggal
		// 							FROM absensi
		// 							WHERE id_pegawai = ?
		// 							AND MONTH(waktu) = ?
		// 							AND YEAR(waktu) = ?
		// 							AND invalidated IS null
		// 							AND DATE(waktu) NOT IN (SELECT tanggal
		// 							                        FROM hari_libur
		// 							                        WHERE MONTH(tanggal) = ?
		// 													AND YEAR(tanggal) = ?)', [$idPegawai, $bulan, $tahun, $bulan, $tahun]);
		// foreach ($tanggalAbsens as $item) {
		// 	$inTanggalLibur[] = $item->tanggal;	
		// }

		// Absensi_model::whereRaw('MONTH(waktu) = ?
		// 						AND YEAR(waktu) = ?', [$bulan, $tahun])
		// 				->where('id_pegawai', $idPegawai)
		// 				->whereNull('invalidated')
		// dd($inTanggalLibur);

		$pegawais = Pegawai_model::with([
			'golongan', 
			'eselon',
		])->get();
		
		return blade('dashboard.absenbulanan', compact(['pegawais', 'bulan', 'tahun']));
	}
}
