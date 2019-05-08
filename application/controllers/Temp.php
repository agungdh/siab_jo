<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Temp extends CI_Controller {
	public function index()
	{
		dd(helper()->apakahLibur());
	}
}
