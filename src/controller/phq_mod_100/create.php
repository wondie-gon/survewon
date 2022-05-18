<?php
// autoloader
require_once '../../../vendor/autoload.php';

use App\Controller\Phq_Mod_100_Api;

// instantiate api
$mod_100 = new Phq_Mod_100_Api();
// insert to db
$mod_100->post_data();

