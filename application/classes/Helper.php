<?php
namespace application\classes;

use Illuminate\Database\Capsule\Manager as DB;
use application\eloquents\HariLibur as HariLibur_model;
use application\eloquents\User as User_model;
use application\eloquents\IjinAbsensi as IjinAbsensi_model;

class Helper extends \agungdh\Pustaka
{
	public static function tidakSesuaiWaktu($id_pegawai, $bulan, $tahun, $terlambat = true)
	{
		$pembanding = $terlambat ? '>' : '<';
		$tsw = DB()
					->table('absensi')
					->where('id_pegawai', $id_pegawai)
					->where('tipe', $terlambat ? 'b' : 'p')
					->whereNull('invalidated')
					->whereRaw('TIME(waktu) ' . $pembanding . ' ?
								AND MONTH(waktu) = ?
								AND YEAR(waktu) = ?',
								[
									$terlambat ? getenv('WAKTU_BERANGKAT') : getenv('WAKTU_PULANG'),
									$bulan,
									$tahun,
								])
					->get();
					
		$durasi = 0;
		foreach ($tsw as $item) {
			$harus = helper()->convertJamMenitKeMenit($terlambat ? getenv('WAKTU_BERANGKAT') : getenv('WAKTU_PULANG'));
			$waktuAbsensi = helper()->convertJamMenitKeMenit(date('H:i', strtotime($item->waktu)));

			if ($terlambat && $waktuAbsensi > $harus) {
				$durasi += abs($harus - $waktuAbsensi);
			} elseif (!$terlambat && $waktuAbsensi < $harus) {
				$durasi += abs($harus - $waktuAbsensi);
			}
		}

		return self::parsedMenitKeJamMenit($durasi);
	}

	public static function apakahHariIniIjin()
	{
		$ia = IjinAbsensi_model::where(['id_pegawai' => getUserData()->pegawai->id, 'tanggal' => date('Y-m-d')])->first();

		if ($ia) {
			return true;
		} else {
			return false;
		}
	}

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