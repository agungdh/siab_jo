<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Welcome extends CI_Controller {
	public function index()
	{
		if ($this->session->login) {
			$user = getUserData();
			$pegawai = $user->pegawai;
			$absensis = $pegawai->absensis;
			$absensisToday = $pegawai->absensisToday;
			$absensisTodayBerangkat = $pegawai->absensisTodayBerangkat;
			$absensisTodayPulang = $pegawai->absensisTodayPulang;
			
			return blade('dashboard.index', compact(['user', 'pegawai', 'absensis', 'absensisToday', 'absensisTodayBerangkat', 'absensisTodayPulang']));
		} else {
			return blade('template.login');
		}
	}
}
