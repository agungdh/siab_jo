<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\QueryException;

use application\eloquents\Pegawai as Pegawai_model;

class Pegawai extends CI_Controller {

	public function index()
	{
		$pegawais = Pegawai_model::all();

		return blade('pegawai.index', compact(['pegawais']));
	}

	public function tambah()
	{
		return blade('pegawai.tambah', compact([]));
	}

	public function aksitambah()
	{
		$requestData = $this->input->post();
		
		$validator = validator()->make($requestData, [
			'id_golongan' => 'required',
			'id_eselon' => 'required',
			'nip' => 'required',
			'nama' => 'required',
		]);

		if (Pegawai_model::where(['nip' => $requestData['nip']])->first()) {
			$validator->errors()->add('nip', 'NIP sudah ada !!!');
		}

		if (count($validator->errors()) > 0) {
			$this->session->set_flashdata('errors', $validator->errors());
			$this->session->set_flashdata('old', $requestData);
			
			redirect(base_url('pegawai/tambah'));
		}

		Pegawai_model::insert($requestData);
		
		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Tambah Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('pegawai'));
	}

	public function ubah($id)
	{
		$pegawai = Pegawai_model::find($id);

		return blade('pegawai.ubah', compact(['pegawai']));
	}

	public function aksiubah($id)
	{
		$pegawai = Pegawai_model::find($id);

		$requestData = $this->input->post();
		
		$validator = validator()->make($requestData, [
			'id_golongan' => 'required',
			'id_eselon' => 'required',
			'nip' => 'required',
			'nama' => 'required',
		]);

		if ($requestData['nip'] != $pegawai->nip && Pegawai_model::where(['nip' => $requestData['nip']])->first()) {
			$validator->errors()->add('nip', 'NIP sudah ada !!!');
		}

		if (count($validator->errors()) > 0) {
			$this->session->set_flashdata('errors', $validator->errors());
			$this->session->set_flashdata('old', $requestData);
			
			redirect(base_url('pegawai/ubah/' . $id));
		}

		Pegawai_model::where('id', $id)->update($requestData);
		
		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Ubah Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('pegawai'));
	}

	public function aksihapus($id)
	{
		try {
			Pegawai_model::where('id', $id)->delete();
		} catch (QueryException $exception) {
            $this->session->set_flashdata(
			'alert',
			[
				'title' => 'ERROR !!!',
                'message' => getenv('CI_ENV') == 'development' ? $exception->getMessage() : 'Something Went Wrong !!!',
                'class' => 'error',
			]);

			redirect(base_url('pegawai'));
        }

		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Hapus Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('pegawai'));
	}
}
