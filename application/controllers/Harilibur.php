<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
use application\eloquents\HariLibur as HariLibur_model;

class Harilibur extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		helper()->auth(['a']);
	}

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
			'tanggal' => 'required',
			'keterangan' => 'required',
		]);

		$requestData['tanggal'] = $requestData['tanggal'] ? helper()->parseTanggalIndo($requestData['tanggal']) : null;

		if (HariLibur_model::where(['tanggal' => $requestData['tanggal']])->first()) {
			$validator->errors()->add('tanggal', 'Tanggal sudah ada !!!');
		}

		if (count($validator->errors()) > 0) {
			$requestData['tanggal'] = $requestData['tanggal'] ? helper()->tanggalIndo($requestData['tanggal']) : null;
		
			$this->session->set_flashdata('errors', $validator->errors());
			$this->session->set_flashdata('old', $requestData);
			
			redirect(base_url('harilibur/tambah'));
		}

		HariLibur_model::insert($requestData);
		
		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Tambah Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('harilibur'));
	}

	public function ubah($id)
	{
		$hariLibur = HariLibur_model::find($id);
		$hariLibur->tanggal = helper()->tanggalIndo($hariLibur->tanggal);

		return blade('harilibur.ubah', compact(['hariLibur']));
	}

	public function aksiubah($id)
	{
		$hariLibur = HariLibur_model::find($id);

		$requestData = $this->input->post();
		
		$validator = validator()->make($requestData, [
			'tanggal' => 'required',
			'keterangan' => 'required',
		]);

		$requestData['tanggal'] = $requestData['tanggal'] ? helper()->parseTanggalIndo($requestData['tanggal']) : null;

		if ($requestData['tanggal'] != $hariLibur->tanggal && HariLibur_model::where(['tanggal' => $requestData['tanggal']])->first()) {
			$validator->errors()->add('tanggal', 'Tanggal sudah ada !!!');
		}

		if (count($validator->errors()) > 0) {
		$requestData['tanggal'] = $requestData['tanggal'] ? helper()->tanggalIndo($requestData['tanggal']) : null;

			$this->session->set_flashdata('errors', $validator->errors());
			$this->session->set_flashdata('old', $requestData);
			
			redirect(base_url('harilibur/ubah/' . $id));
		}

		HariLibur_model::where('id', $id)->update($requestData);
		
		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Ubah Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('harilibur'));
	}

	public function aksihapus($id)
	{
		try {
			HariLibur_model::where('id', $id)->delete();
		} catch (QueryException $exception) {
            $this->session->set_flashdata(
			'alert',
			[
				'title' => 'ERROR !!!',
                'message' => getenv('CI_ENV') == 'development' ? $exception->getMessage() : 'Something Went Wrong !!!',
                'class' => 'error',
			]);

			redirect(base_url('harilibur'));
        }

		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Hapus Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('harilibur'));
	}
}