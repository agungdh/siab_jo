<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
use application\eloquents\HariLibur as HariLibur_model;

class Harilibur extends CI_Controller {
	public function index()
	{
		return blade('harilibur.index', compact([]));
	}

	public function tambah()
	{
		return blade('harilibur.tambah', compact([]));
	}

	public function aksitambah()
	{
		$requestData = $this->input->post();
		
		$validator = validator()->make($requestData, [
			'nip' => 'required',
			'nama' => 'required',
		]);

		if (Karyawan_model::where(['nip' => $requestData['nip']])->first()) {
			$validator->errors()->add('nip', 'NIP sudah ada !!!');
		}

		if (count($validator->errors()) > 0) {
			$this->session->set_flashdata('errors', $validator->errors());
			$this->session->set_flashdata('old', $requestData);
			
			redirect(base_url('karyawan/tambah'));
		}

		Karyawan_model::insert($requestData);
		
		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Tambah Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('karyawan'));
	}

	public function ubah($id)
	{
		$hariLiburs = $this->hariLiburs;

		$karyawan = Karyawan_model::find($id);

		return blade('harilibur.ubah', compact(['karyawan']));
	}

	public function aksiubah($id)
	{
		$karyawan = Karyawan_model::find($id);

		$requestData = $this->input->post();
		
		$validator = validator()->make($requestData, [
			'nip' => 'required',
			'nama' => 'required',
		]);

		if ($requestData['nip'] != $karyawan->nip && Karyawan_model::where(['nip' => $requestData['nip']])->first()) {
			$validator->errors()->add('nip', 'NIP sudah ada !!!');
		}

		if (count($validator->errors()) > 0) {
			$this->session->set_flashdata('errors', $validator->errors());
			$this->session->set_flashdata('old', $requestData);
			
			redirect(base_url('karyawan/ubah/' . $id));
		}

		Karyawan_model::where('id', $id)->update($requestData);
		
		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Ubah Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('karyawan'));
	}

	public function aksihapus($id)
	{
		try {
			Karyawan_model::where('id', $id)->delete();
		} catch (QueryException $exception) {
            $this->session->set_flashdata(
			'alert',
			[
				'title' => 'ERROR !!!',
                'message' => getenv('CI_ENV') == 'development' ? $exception->getMessage() : 'Something Went Wrong !!!',
                'class' => 'error',
			]);

			redirect(base_url('karyawan'));
        }

		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Hapus Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('karyawan'));
	}
}