<?php
namespace App\Controller;

use App\Controller\HttpApi;
use App\Database\SUWONDB;
use App\Model\Phq_Mod_100;

/**
 * Api for phq_mod_100 data
 */
class Phq_Mod_100_Api extends HttpApi
{
    public function __construct()
	{
		$this->conn = $this->connect_db();

		$this->obj_instance = $this->init_model( $this->conn );
	}

	protected function connect_db() {
		$pdo = new SUWONDB();
		return $pdo->connect();
	}

	protected function init_model( $conn ) {
		$users = new Phq_Mod_100( $conn );
		return $users;
	}
}
