<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\QueryException;

use application\eloquents\User as User_model;
use application\eloquents\Pegawai as Pegawai_model;

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		helper()->auth(['a']);
	}

	public function index()
	{
		$users = User_model::with('pegawai')->get();

		return blade('user.index', compact(['users']));
	}

	public function tambah()
	{
		$pegawais = Pegawai_model::all();

		return blade('user.tambah', compact(['pegawais']));
	}

	public function aksitambah()
	{
		$requestData = $this->input->post();
		
		$validator = validator()->make($requestData, [
			'id_pegawai' => 'required',
			'level' => 'required',
			'password' => 'required|confirmed',
		]);

		if (User_model::where(['id_pegawai' => $requestData['id_pegawai']])->first()) {
			$validator->errors()->add('id_pegawai', 'User sudah ada !!!');
		}

		if (count($validator->errors()) > 0) {
			$this->session->set_flashdata('errors', $validator->errors());
			$this->session->set_flashdata('old', $requestData);
			
			redirect(base_url('user/tambah'));
		}

		unset($requestData['password_confirmation']);
		$requestData['password'] = password_hash($requestData['password'], PASSWORD_BCRYPT);

		User_model::insert($requestData);
		
		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Tambah Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('user'));
	}

	public function ubah($id)
	{
		$pegawais = Pegawai_model::all();
		$user = User_model::find($id);

		return blade('user.ubah', compact(['user', 'pegawais']));
	}

	public function aksiubah($id)
	{
		$user = User_model::find($id);

		$requestData = $this->input->post();
		
		$validator = validator()->make($requestData, [
			'id_pegawai' => 'required',
			'level' => 'required',
			'password' => 'confirmed',
		]);

		if ($requestData['id_pegawai'] != $user->id_pegawai && User_model::where(['id_pegawai' => $requestData['id_pegawai']])->first()) {
			$validator->errors()->add('id_pegawai', 'User sudah ada !!!');
		}

		if (count($validator->errors()) > 0) {
			$this->session->set_flashdata('errors', $validator->errors());
			$this->session->set_flashdata('old', $requestData);
			
			redirect(base_url('user/ubah/' . $id));
		}

		unset($requestData['password_confirmation']);
		if ($requestData['password']) {
			$requestData['password'] = password_hash($requestData['password'], PASSWORD_BCRYPT);
		} else {
			unset($requestData['password']);
		}

		User_model::where('id', $id)->update($requestData);
		
		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Ubah Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('user'));
	}

	public function aksihapus($id)
	{

		if ($this->session->userID == $id) {
			$this->session->set_flashdata(
				'alert',
				[
					'title' => 'ERROR !!!',
					'message' => 'Tidak Dapat Menghapus User Sendiri !!!',
					'class' => 'error',
				]
			);

			redirect(base_url('user'));
		}

		try {
			User_model::where('id', $id)->delete();
		} catch (QueryException $exception) {
            $this->session->set_flashdata(
			'alert',
			[
				'title' => 'ERROR !!!',
                'message' => getenv('CI_ENV') == 'development' ? $exception->getMessage() : 'Something Went Wrong !!!',
                'class' => 'error',
			]);

			redirect(base_url('user'));
        }

		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Hapus Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('user'));
	}
}
