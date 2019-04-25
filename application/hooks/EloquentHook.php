<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class EloquentHook {

	public function bootEloquent() {
		$capsule = new Capsule;

		$capsule->addConnection([
			"driver"    => "mysql",
			"host" => getenv('DB_HOST'),
			"database" => getenv('DB_DB'),
			"username" => getenv('DB_USER'),
			"password" => getenv('DB_PASS')
		]);

		$capsule->setAsGlobal();
		$capsule->bootEloquent();
	}

}