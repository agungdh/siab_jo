<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
use application\eloquents\HariLibur as HariLibur_model;
use PHPJasper\PHPJasper;

class Temp extends CI_Controller {
	public function index()
	{
		$datas = HariLibur_model::whereRaw('year(tanggal) in (?,?,?)', [date('Y') - 1, date('Y'), date('Y') + 1])->get();

		dd($datas);
	}

	public function jasper()
	{
		// $input = FCPATH . 'vendor\geekcom\phpjasper\examples\json.jrxml';   
		// $jasper = new PHPJasper;
		// $jasper->compile($input)->execute();

		$input = FCPATH . 'vendor\geekcom\phpjasper\examples\json.jrxml';   
		$output = FCPATH . 'vendor\geekcom\phpjasper\examples';   

		$data_file = FCPATH . 'vendor\geekcom\phpjasper\examples\contacts.json';   
		$options = [
		    'format' => ['pdf'],
		    'params' => [],
		    'locale' => 'en',
		    'db_connection' => [
		        'driver' => 'json',
		        'data_file' => $data_file,
		        'json_query' => 'contacts.person'
		    ]
		];

		$jasper = new PHPJasper;

		$jasper->process(
		    $input,
		    $output,
		    $options
		)->execute();

		// dd($jasper);
	}
}
