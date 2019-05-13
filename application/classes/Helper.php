<?php
namespace application\classes;

use Illuminate\Database\Capsule\Manager as DB;
use application\eloquents\HariLibur as HariLibur_model;
use application\eloquents\User as User_model;

class Helper extends \agungdh\Pustaka
{
	public function pegawaiAbsensisToday()
	{
		return User_model::with('pegawai.absensisToday')->find(ci()->session->userID)->pegawai;
	}

	public function apakahLibur()
	{
		$checkForLibur = DB::table('hari_libur')->where('tanggal', date('Y-m-d'))->first();

		$numDay = date('N');
		if ($numDay == 6 || $numDay == 7 || $checkForLibur) {
			return true;
		} else {
			return false;
		}
	}

	public function tanggalKalender3Tahun()
	{
		return HariLibur_model::whereRaw('year(tanggal) in (?,?,?)', [date('Y') - 1, date('Y'), date('Y') + 1])->get();
	}
}