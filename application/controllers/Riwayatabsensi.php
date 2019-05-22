<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
use application\eloquents\Absensi as Absensi_model;
use application\eloquents\Pegawai as Pegawai_model;

class Riwayatabsensi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		helper()->auth(['a', 'p']);
	}

	public function index()
	{	
		$pegawais = Pegawai_model::all();
		$userData = getUserData();

		return blade('riwayatabsensi.index', compact(['pegawais', 'userData']));
	}

	public function getDataAbsensi($id_pegawai = "0", $tanggal = "0", $sampai = "0", $validity = "1")
	{
		$datas = new Absensi_model();
		$datas = $datas->with('pegawai');

		if ($id_pegawai != '0') {
			$datas = $datas->where('id_pegawai', $id_pegawai);
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

		if ($validity == '0') {
			$datas = $datas->whereNotNull('invalidated');
		} elseif ($validity == '1') {
			$datas = $datas->whereNull('invalidated');
		}

		$datas = $datas->get();
		
		return blade('riwayatabsensi.getDataAbsensi', compact(['datas']));
	}

	public function validate($id)
	{
		Absensi_model::where('id', $id)->update(['invalidated' => null]);

		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Validate Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('riwayatabsensi'));
	}

	public function invalidate($id)
	{
		Absensi_model::where('id', $id)->update(['invalidated' => 'y']);

		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Invalidate Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('riwayatabsensi'));
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
