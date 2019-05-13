<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

use application\eloquents\Pegawai as Pegawai_model;

class Log extends CI_Controller {

	public function in()
	{
		$requestData = $this->input->post();
		
		$validator = validator()->make($requestData, [
			'nip' => 'required',
			'password' => 'required',
		]);

		if ($validator->passes()) {
			$pegawai = Pegawai_model::where(['nip' => $requestData['nip']])->first();
			if (!($pegawai && $pegawai->user && password_verify($requestData['password'], $pegawai->user->password))) {
				$validator->errors()->add('nip', 'NIP / Password Salah !!!');
				$validator->errors()->add('password', 'NIP / Password Salah !!!');
			}
		}

		if (count($validator->errors()) > 0) {
			$this->session->set_flashdata('errors', $validator->errors());
			$this->session->set_flashdata('old', $requestData);
		} else {
			$this->session->set_userdata([
				'userID' => $pegawai->user->id,
				'login' => true,
			]);
		}

		redirect(base_url());
	}

	public function out() {
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
