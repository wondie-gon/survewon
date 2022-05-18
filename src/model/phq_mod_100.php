<?php
namespace App\Model;
use App\Model\CRUDBase;

class Phq_Mod_100 extends CRUDBase
{
    protected $table = "phq_mod_100";
	
	public function __construct( $conn )
	{
		parent::__construct( $conn );
	}
}

