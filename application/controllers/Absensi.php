<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\QueryException;

use application\eloquents\Karyawan as Karyawan_model;

class Absensi extends CI_Controller {
	public function index()
	{
		$karyawan = Karyawan_model::with('absensisToday')->find(10);

		return blade('absensi.index', compact(['karyawan']));
	}

	public function absen()
	{
		$karyawan = Karyawan_model::with('absensisToday')->find(10);
		$absensisToday = $karyawan->absensisToday;
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
		$requestData['id_karyawan'] = 10;
		$requestData['lat'] = $this->input->post('lat');
		$requestData['lng'] = $this->input->post('lng');
		$requestData['lokasi'] = $this->input->post('lokasi');
		$requestData['waktu'] = date('Y-m-d H:i:s');
		$requestData['tipe'] = $tipe;

		$foto = $_FILES['foto'];

		$id = DB::table('absensi')->insertGetId($requestData);

		move_uploaded_file($foto['tmp_name'], 'uploads/fotoabsen/' . $id);

		dd($requestData);
	}
}
