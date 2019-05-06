<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Welcome extends CI_Controller {

	public function index()
	{
		if ($this->session->login) {
			$user = getUserData();
			$karyawan = $user->karyawan;
			$absensis = $karyawan->absensis;

			return blade('dashboard.index', compact(['user', 'karyawan', 'absensis']));
		} else {
			return blade('template.login');
		}
	}
}
