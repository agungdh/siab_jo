<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\QueryException;

use application\eloquents\Karyawan as Karyawan_model;

class Karyawan extends CI_Controller {

	public function index()
	{
		$karyawans = Karyawan_model::all();

		return blade('karyawan.index', compact(['karyawans']));
	}

	public function tambah()
	{
		return blade('karyawan.tambah', compact([]));
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
		$karyawan = Karyawan_model::find($id);

		return blade('karyawan.ubah', compact(['karyawan']));
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
				'message' => 'Tambah Data Berhasil !!!',
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
