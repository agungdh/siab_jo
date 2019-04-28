<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Welcome extends CI_Controller {

	public function index()
	{
		if ($this->session->login) {
			return blade('template.template');
		} else {
			return blade('template.login');
		}
	}
}
