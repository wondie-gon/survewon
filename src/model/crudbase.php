<?php
namespace App\Model;
use App\Model\ICrud;

/**
 * Base class for crud functionalities
 */
class CRUDBase implements ICrud {

	//Database connection object
	protected $conn = null;

	//Data table name
	protected $table;

	//Connect to the database and set the default data table name
	public function __construct( $conn ) {
		$this->conn = $conn;
	}

	/** 
     * return prepared fields to use in insert statement
     * like this ' (key1, key2, ...) '
     * @param array $data data array sent to create new record
     */
	public function get_field_params( $data ) {
		return ' (' . implode( ', ', array_keys( $data ) ) . ') ';
	}

	/** 
     * return prepared values to use in insert statement
     * like this ' (:key1, :key2, ...)'
     * @param array $data data array sent to create new record
     */
	public function get_named_value_params( $data ) {
		$vals = array_map( function( $item ) {
			return ':' . $item;
		}, array_keys( $data ) );

		return ' (' . implode(', ', $vals) . ')';
	}
	/** 
     * Creating new record into table  
     * @param array $data data array sent to create new record
     */ 
	public function create( $data ) {
		if ( ! empty( $data ) && is_array( $data ) ) {
			$sql = "INSERT INTO " . $this->table . $this->get_field_params( $data ) . "VALUES" . $this->get_named_value_params( $data );

            $stmt = $this->conn->prepare( $sql );

            foreach ( $data as $key => $val ) { 
                 $stmt->bindValue( ':' . $key, $val );
            }

            $insert = $stmt->execute();

            return $insert ? $this->conn->lastInsertId() : false; 
		} else {
			return false;
		}
	}

	/** 
     * Returns rows from the table based on the conditions  
     * @param array select, where, order_by, limit and return_type conditions 
     */ 
    public function read( $conditions = array() ) { 
        $sql = 'SELECT '; 
        $sql .= array_key_exists( "select", $conditions ) ? $conditions['select'] : '*';
        $sql .= ' FROM ' . $this->table; 
        if ( array_key_exists( "where", $conditions ) ) { 
            $sql .= ' WHERE '; 
            $i = 0; 
            foreach ( $conditions['where'] as $key => $value ) { 
                $pre = ( $i > 0 ) ? ' AND ' : ''; 
                $sql .= $pre . $key . " = '" . $value . "'"; 
                $i++; 
            } 
        } 
        // order by
        if ( array_key_exists( "order_by", $conditions ) ) { 
            $sql .= ' ORDER BY ' . $conditions['order_by'];  
        }
        // add order if order_by is set
        if ( array_key_exists( "order_by", $conditions ) ) {
            $sql .= ' ' . array_key_exists( "order", $conditions ) ? strtoupper( $conditions["order"] ) : 'DESC';
        } 
        
        // limit constraint
        if ( array_key_exists( "start", $conditions ) && array_key_exists( "limit", $conditions ) ) { 
            $sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit'];  
        } elseif ( !array_key_exists( "start", $conditions ) && array_key_exists( "limit", $conditions ) ) { 
            $sql .= ' LIMIT ' . $conditions['limit'];
        } 
         
        $stmt = $this->conn->prepare( $sql ); 
        $stmt->execute(); 
         
        if ( array_key_exists( "return_type", $conditions ) && $conditions['return_type'] != 'all' ) { 
            switch ( $conditions['return_type'] ) { 
                case 'count': 
                    $data = $stmt->rowCount(); 
                    break; 
                case 'single': 
                    $data = $stmt->fetch( \PDO::FETCH_ASSOC ); 
                    break; 
                default: 
                    $data = ''; 
            } 
        } else { 
            if ( $stmt->rowCount() > 0 ) { 
                $data = $stmt->fetchAll(); 
            } 
        } 
        return !empty( $data ) ? $data : false; 
    }

	/**
	* method to get assembled set statement 
	*
	* To be used in create and update methods
	*/
	public function assembled_set_placeholder( $data ) {
		// Get the array of key names of the array
		$keyArr = array_keys( $data );
		// initialize set statement output
		$set = '';
		// traversing data and get array keys to construct assembled set statement
		foreach ( $keyArr as $value ) {
			$set .= $value . ' = :' . $value . ', ';
		}
		// Remove the last comma by maintaining the space 
		$set = rtrim( $set, ',' );

		return $set;

	}

	/** 
     * Update data 
     * @param array $data the data for updating into the table 
     * @param array $conditions conditions for updating data, 
     							including where
     */ 
    public function update( $data, $conditions ){ 
        if ( !empty( $data ) && is_array( $data ) ){ 
            $colvalSet = ''; 
            $whereSql = ''; 
            $i = 0; 
            if ( ! array_key_exists( 'modified', $data ) ){ 
                $data['modified'] = date( "Y-m-d H:i:s" ); 
            } 
            foreach ( $data as $key => $val ){ 
                $pre = ( $i > 0 ) ? ', ' : ''; 
                $colvalSet .= $pre . $key . " = '" . $val . "'"; 
                $i++; 
            } 
            if ( !empty( $conditions )&& is_array( $conditions ) ){ 
                $whereSql .= ' WHERE '; 
                $i = 0; 
                foreach ( $conditions as $key => $value ){ 
                    $pre = ( $i > 0 ) ? ' AND ' : ''; 
                    $whereSql .= $pre . $key . " = '" . $value . "'"; 
                    $i++; 
                } 
            } 
            $sql = "UPDATE " . $this->table . " SET " . $colvalSet . $whereSql; 
            $stmt = $this->conn->prepare( $sql ); 
            $update = $stmt->execute(); 
            return $update ? $stmt->rowCount() : false; 
        } else { 
            return false;
        } 
    }

	/** 
     * Delete data from the table 
     * @param array $conditions the conditions to specify data to delete 
     */ 
    public function delete( $conditions ) { 
        $whereSql = ''; 
        if( !empty( $conditions ) && is_array( $conditions ) ) { 
            $whereSql .= ' WHERE '; 
            $i = 0; 
            foreach ( $conditions as $key => $value ){ 
                $pre = ( $i > 0 ) ? ' AND ' : ''; 
                $whereSql .= $pre . $key . " = '" . $value . "'"; 
                $i++; 
            } 
        } 
        $sql = "DELETE FROM " . $this->table . $whereSql;
        $delete = $this->conn->exec( $sql ); 
        return $delete ? $delete : false; 
    }

} // End class
