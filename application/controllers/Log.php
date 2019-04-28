<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Log extends CI_Controller {

	public function in()
	{
		$requestData = $this->input->post();
		
		$validator = validator()->make($requestData, [
			'username' => 'required',
			'password' => 'required',
		]);

		if ($validator->passes()) {
			$user = DB::table('user')->where(['username' => $requestData['username']])->first();
			if (!($user && password_verify($requestData['password'], $user->password))) {
				$validator->errors()->add('username', 'Username / Password Salah !!!');
				$validator->errors()->add('password', 'Username / Password Salah !!!');
			}
		}

		if (count($validator->errors()) > 0) {
			$this->session->set_flashdata('errors', $validator->errors());
			$this->session->set_flashdata('old', $requestData);
		} else {
			$this->session->set_userdata([
				'userID' => $user->id,
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
