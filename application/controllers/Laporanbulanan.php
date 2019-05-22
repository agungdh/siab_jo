<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
use application\eloquents\Absensi as Absensi_model;
use application\eloquents\Pegawai as Pegawai_model;

class Laporanbulanan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		helper()->auth(['a']);
	}

	public function index()
	{	
		return blade('laporanbulanan.index');
	}

	public function cetak($bulan, $tahun)
	{
		$pegawais = Pegawai_model::with([
			'golongan', 
			'eselon',
		])->get();
	
		$dompdf = new Dompdf\Dompdf();
		$dompdf->set_option('defaultFont', 'Courier');
		$dompdf->setPaper('A4', 'landscape');
		$dompdf->loadHtml(bladeHtml('laporanbulanan.pdf', compact(['pegawais', 'bulan', 'tahun'])));
		$dompdf->render();
		$dompdf->stream('Absensi Pegawai BAPPEDA Pringsewu ' . helper()->tanggalIndoStringBulanTahun("{$bulan}-{$tahun}") . '.pdf');
	}

}