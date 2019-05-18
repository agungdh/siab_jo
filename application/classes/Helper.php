<?php
namespace application\classes;

use Illuminate\Database\Capsule\Manager as DB;
use application\eloquents\HariLibur as HariLibur_model;
use application\eloquents\User as User_model;

class Helper extends \agungdh\Pustaka
{
	public static function pegawaiAbsensisToday()
	{
		return User_model::with('pegawai.absensisToday')->find(ci()->session->userID)->pegawai;
	}

	public static function apakahLibur()
	{
		$checkForLibur = DB::table('hari_libur')->where('tanggal', date('Y-m-d'))->first();

		$numDay = date('N');
		if ($numDay == 6 || $numDay == 7 || $checkForLibur) {
			return true;
		} else {
			return false;
		}
	}

	public static function tanggalKalender3Tahun()
	{
		return HariLibur_model::whereRaw('year(tanggal) in (?,?,?)', [date('Y') - 1, date('Y'), date('Y') + 1])->get();
	}

	public static function auth($level) {
		self::bootEloquent();

		if (!(ci()->session->login && in_array(getUserData()->level, $level))) {
			redirect(base_url());
		}
	}

	public static function bootEloquent() {
		$db = new DB;

		$db->addConnection([
			"driver"    => "mysql",
			"host" => getenv('DB_HOST'),
			"database" => getenv('DB_DB'),
			"username" => getenv('DB_USER'),
			"password" => getenv('DB_PASS')
		]);

		$db->setAsGlobal();
		$db->bootEloquent();
	}
}