<?php
namespace App\Controller;
/**
 * Base class for api http request
 */
abstract class HttpApi
{
	protected $conn;

	protected $obj_instance;


	/**
	* Constants for headers
	*/
	const FORMAT_ACCESS_CONTROL_ORIGIN = 'Access-Control-Allow-Origin: %s';
	const FORMAT_CONTENT_TYPE = 'Content-Type: %s';
	const ACCESS_CONTROL_ALLOW_METHODS = 'Access-Control-Allow-Methods: %s';
	const ACCESS_CONTROL_ALLOW_HEADERS = 'Access-Control-Allow-Headers: %s';

	const CONTENT_TYPE_JSON = 'application/json';
	const ALLOWED_HEADER_TYPES = 'Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With';

	// method to connect to db
	abstract protected function connect_db();

	// method to instantiate model object
	abstract protected function init_model( $conn );

	/**
	* Make an HTTP-POST json call
	* @param string $url 
	* @param array $params
	* @return bool | string HTTP-Response body or empty string if request fails or is empty
	*/
	public function post_data() {
		// get header
		$this->get_header( 'POST' );

		// JSON objects will be returned as php associative arrays
		$dataArr = json_decode( file_get_contents( "php://input" ), true );

		if ( $this->obj_instance->create( $dataArr ) ) {
			echo json_encode( array( 'message' => 'Data successfully posted.' ) );
		} else {
			echo json_encode( array( 'message' => 'Data not posted.' ) );
		}
	}

	public function get_data( array $conditions = [] ) {
		// get header
		$this->get_header( 'GET' );

		$result = $this->obj_instance->read( $conditions );

		if ( $result ) {
			$records = array();
			$records['data_arr'] = array();
			foreach ( $result as $row ) {
				array_push( $records['data_arr'], $row );
			}
			echo json_encode( $records );
		} else {
			echo json_encode(
				array( 'message' => 'No data found.' )
				);
		}
	}

	public function update_item( array $conditions = [] ) {
		// get header
		$this->get_header( 'PUT' );

		$data = json_decode( file_get_contents( "php://input" ), true );

		if ( $this->obj_instance->update( $data, $conditions ) ) {
			echo json_encode(
				array('message' => 'Data updated'));
		} else {
			echo json_encode(
				array('message' => 'Data not updated'));
		}
	}

	public function delete_item( array $conditions = [] ) {
		// get header
		$this->get_header( 'DELETE' );

		$data = json_decode( file_get_contents( "php://input" ), true );
		
		if ( $this->obj_instance->delete( $conditions ) ) {
			echo json_encode(
				array('message' => 'Data item deleted'));
		} else {
			echo json_encode(
				array('message' => 'Data item not deleted'));
		}
	}

	/**
	* Helper method to get header for http request
	* 
	* @param string $method Request method
	* @return string Prepared header for the http request method 
	*/
	protected function get_header( $method ) {
		if ( $method === 'GET' ) {
			header( sprintf( self::FORMAT_ACCESS_CONTROL_ORIGIN, '*' ) );
			header( sprintf( self::FORMAT_CONTENT_TYPE, self::CONTENT_TYPE_JSON ) );
		} elseif ( $method === 'POST' || $method === 'PUT' || $method === 'DELETE' ) {
			header( sprintf( self::FORMAT_ACCESS_CONTROL_ORIGIN, '*' ) );
			header( sprintf( self::FORMAT_CONTENT_TYPE, self::CONTENT_TYPE_JSON ) );
			header( sprintf( self::ACCESS_CONTROL_ALLOW_METHODS, $method ) );
			header( sprintf( self::ACCESS_CONTROL_ALLOW_HEADERS, self::ALLOWED_HEADER_TYPES ) );
		}
		
	} 


} // End class