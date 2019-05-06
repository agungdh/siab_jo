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
	}
}
