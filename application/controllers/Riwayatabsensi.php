<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
use application\eloquents\Absensi as Absensi_model;
use application\eloquents\Karyawan as Karyawan_model;

class Riwayatabsensi extends CI_Controller {

	public function index()
	{	
		$karyawans = Karyawan_model::all();
		$userData = getUserData();

		return blade('riwayatabsensi.index', compact(['karyawans', 'userData']));
	}

	public function getDataAbsensi($id_karyawan = "0", $tanggal = "0", $sampai = "0")
	{
		$datas = new Absensi_model();
		$datas = $datas->with('karyawan');

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

			$datas = $datas->whereRaw('date(waktu) >= CAST(? AS DATE)', $tanggal);
		} elseif ($sampai != '0') {
			$sampai = helper()->parseTanggalIndo($sampai);

			$datas = $datas->whereRaw('date(waktu) <= CAST(? AS DATE)', $sampai);
		}

		$datas = $datas->get();
		
		return blade('riwayatabsensi.getDataAbsensi', compact(['datas']));
	}

	public function aksihapus($id)
	{
		try {
			Absensi_model::where('id', $id)->delete();
		} catch (QueryException $exception) {
            $this->session->set_flashdata(
			'alert',
			[
				'title' => 'ERROR !!!',
                'message' => getenv('CI_ENV') == 'development' ? $exception->getMessage() : 'Something Went Wrong !!!',
                'class' => 'error',
			]);

			redirect(base_url('riwayatabsensi'));
        }

		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Hapus Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('riwayatabsensi'));
	}
}
