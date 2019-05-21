<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
use application\eloquents\Pegawai as Pegawai_model;
use application\eloquents\IjinAbsensi as IjinAbsensi_model;
use application\eloquents\Absensi as Absensi_model;

class Ijinabsensi extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		helper()->auth(['a']);
	}

	public function index()
	{
		$ijinAbsensis = IjinAbsensi_model::with('pegawai')->get();
		
		return blade('ijinabsensi.index', compact(['ijinAbsensis']));
	}

	public function tambah()
	{
		$pegawais = Pegawai_model::all();

		return blade('ijinabsensi.tambah', compact(['pegawais']));
	}

	public function aksitambah()
	{
		$requestData = $this->input->post();
		
		$validator = validator()->make($requestData, [
			'id_pegawai' => 'required',
			'tipe' => 'required',
			'tanggal' => 'required',
		]);

		$requestData['tanggal'] = $requestData['tanggal'] ? helper()->parseTanggalIndo($requestData['tanggal']) : null;

		if ($validator->passes()) {
			if (IjinAbsensi_model::where(['tanggal' => $requestData['tanggal'], 'id_pegawai' => $requestData['id_pegawai']])->first()) {
				$validator->errors()->add('tanggal', 'Ijin absensi sudah ada !!!');
			}

			if (Absensi_model::where(['id_pegawai' => $requestData['id_pegawai']])->whereRaw('date(waktu) = ?', $requestData['tanggal'])->first()) {
				$validator->errors()->add('tanggal', 'Pegawai telah melakukan absensi !!!');
			}
		}

		if (count($validator->errors()) > 0) {
			$requestData['tanggal'] = $requestData['tanggal'] ? helper()->tanggalIndo($requestData['tanggal']) : null;
		
			$this->session->set_flashdata('errors', $validator->errors());
			$this->session->set_flashdata('old', $requestData);
			
			redirect(base_url('ijinabsensi/tambah'));
		}

		$requestData['keterangan'] = $requestData['keterangan'] ?: null;

		IjinAbsensi_model::insert($requestData);
		
		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Tambah Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('ijinabsensi'));
	}

	public function aksihapus($id)
	{
		try {
			IjinAbsensi_model::where('id', $id)->delete();
		} catch (QueryException $exception) {
            $this->session->set_flashdata(
			'alert',
			[
				'title' => 'ERROR !!!',
                'message' => getenv('CI_ENV') == 'development' ? $exception->getMessage() : 'Something Went Wrong !!!',
                'class' => 'error',
			]);

			redirect(base_url('ijinabsensi'));
        }

		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Hapus Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('ijinabsensi'));
	}
}