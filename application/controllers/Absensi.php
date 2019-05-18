<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\QueryException;

use application\eloquents\Pegawai as Pegawai_model;

class Absensi extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		helper()->auth(['a', 'p']);
	}

	public function index()
	{
		$pegawai = helper()->pegawaiAbsensisToday();

		return blade('absensi.index', compact(['pegawai']));
	}

	public function absen()
	{
		$pegawai = Pegawai_model::with('absensisToday')->find(getUserData()->pegawai->id);
		$absensisToday = $pegawai->absensisToday;
		$countAbsensisToday = count($absensisToday);

		if ($countAbsensisToday == 0) {
            $tipe = "b";
        } elseif ($countAbsensisToday == 1) {
            $tipe = "p";
        } else {
        	$this->session->set_flashdata(
				'alert',
				[
					'title' => 'Error',
					'message' => 'Anda tidak bisa absen lagi !!!',
					'class' => 'error',
				]
			);

            redirect(base_url('absensi'));
        }

		$requestData = [];
		$requestData['id_pegawai'] = getUserData()->pegawai->id;
		$requestData['lat'] = $this->input->post('lat');
		$requestData['lng'] = $this->input->post('lng');
		$requestData['lokasi'] = $this->input->post('lokasi');
		$requestData['waktu'] = date('Y-m-d H:i:s');
		$requestData['tipe'] = $tipe;

		$foto = $_FILES['foto'];

		$id = DB::table('absensi')->insertGetId($requestData);

		move_uploaded_file($foto['tmp_name'], 'uploads/fotoabsen/' . $id);

		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Anda berhasil absen !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('absensi'));
	}
}
