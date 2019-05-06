<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
use application\eloquents\User as User_model;
use application\eloquents\Karyawan as Karyawan_model;

class Profil extends CI_Controller {

	public function index()
	{
		$user = getUserData();
		
		return blade('template.profil', compact(['user']));
	}

	public function ubah()
	{
		$requestData = $this->input->post();
		
		$validator = validator()->make($requestData, [
			'password' => 'required|confirmed',
		]);

		if (count($validator->errors()) > 0) {
			$this->session->set_flashdata('errors', $validator->errors());
			$this->session->set_flashdata('old', $requestData);
			
			redirect(base_url('profil'));
		}

		unset($requestData['password_confirmation']);
		$requestData['password'] = password_hash($requestData['password'], PASSWORD_BCRYPT);

		User_model::where('id', $this->session->userID)->update($requestData);

		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Ubah Profil Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('profil'));
	}
}