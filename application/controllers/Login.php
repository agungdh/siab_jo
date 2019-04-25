<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Login extends CI_Controller {

	public function index()
	{
		return blade('template.login');
	}

	public function action()
	{
		// $requestData = $this->input->post();
		
		// $validator = validator()->make($requestData, [
		// 	'username' => 'required',
		// 	'password' => 'required',
		// ]);

		// if ($validator->passes()) {
		// 	if (DB::table('karyawan')->where(['nip' => $requestData['username']])->first()) {
		// 		$validator->errors()->add('username', 'exist');
		// 	}
		// }

		// if (count($validator->errors()) > 0) {
		// 	$this->session->set_flashdata('errors', $validator->errors());
		// 	$this->session->set_flashdata('old', $requestData);
			
		// 	redirect(base_url('login'));
		// }
		

		// echo password_hash("rasmuslerdorf", PASSWORD_BCRYPT);
		// dd(password_verify('rasmuslerdorf', '$2y$10$ttI76.E1PKZdiENIQD8rzeqZ6LQyFGmZoQBdU07rI5RE/PK1JORRa'));
		// die;

		// $this->session->set_flashdata(
		// 	'alert',
		// 	[
		// 		'title' => 'Judul',
		// 		'message' => 'Pesan',
		// 		'class' => 'warning',
		// 	]
		// );
	}
}
