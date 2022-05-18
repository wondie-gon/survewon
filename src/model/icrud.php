<?php
namespace App\Model;
/**
* CRUD Interface
*
*/
interface ICrud {
	// create new record
	public function create( $data );
	// read
	public function read( $conditions = array() );
	// update
	public function update( $data, $conditions );
	// delete
	public function delete( $conditions );
}