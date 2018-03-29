<?php
/**
 * 	Table Access Class
 *	Copyright Dalegroup Pty Ltd 2012
 *	support@dalegroup.net
 *
 *  This class allows basic Add/Edit/Delete functions for any generic table
 *
 * @package     dgx
 * @author      Michael Dale <mdale@dalegroup.net>
 */

namespace sts;

class table_access {

	private $table_name 			= NULL;
	private $base_table_name 		= NULL;
	private $allowed_columns 		= NULL;

	function __construct() {
		

	}
	
	public function set_table($table_name) {
		if (empty($table_name)) return false;
		
		$this->base_table_name	= $table_name;
	
		$tables 		= &singleton::get(__NAMESPACE__ . '\tables');

		$tables->add_table($table_name);
	
		$this->table_name = $tables->$table_name;	
	}
	
	public function get_table() {
		return $this->table_name;
	}
	
	public function allowed_columns($array) {
		$this->allowed_columns = $array;
	}
	public function get_allowed_columns() {
		return $this->allowed_columns;
	}
	
	/**
	 * Adds a value into the database table
	 *
	 * Form the array like this:
	 * <code>
	 * $array = array(
	 * 	'columns' => array( 	
	 *		'username'    	=> 'admin',
	 *   	'password'   	=> '1234'
	 *	)
	 * );
	 * 
	 * </code>
	 *
	 * @param   array   $array 			The array explained above
	 * @return  int						The ID of the added value
	 */
	public function add($array) {
		global $db;
				
		$error 			= &singleton::get(__NAMESPACE__ . '\error');
		$log			= &singleton::get(__NAMESPACE__ . '\log');
		$config 		= &singleton::get(__NAMESPACE__ . '\config');

		$site_id		= SITE_ID;
		
		$query = "INSERT INTO $this->table_name (site_id";

		if (isset($array['columns'])) {
			foreach($array['columns'] as $index => $value) {
				if (in_array($index, $this->allowed_columns)) {
					$query .= ', `' . $index . '`';
					unset($index);
					unset($value);
				}
			}
		}
		
		$query .= ") VALUES (:site_id";
	
		if (isset($array['columns'])) {
			foreach($array['columns'] as $index => $value) {
				if (in_array($index, $this->allowed_columns)) {
					$query .= ', :' . $index;
					unset($index);
					unset($value);
				}
			}
		}
	
		$query .= ")";
		
		//echo $query;
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));		
		}
		
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);

		if (isset($array['columns'])) {
			foreach($array['columns'] as $index => $value) {
				if (in_array($index, $this->allowed_columns)) {
					$stmt->bindParam(':' . $index, $value);
					unset($index);
					unset($value);
				}
			}
		}	
		
		try {
			$stmt->execute();
			$id = $db->lastInsertId();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
				
		return $id;
		
	}
	
	
	public function edit($array) {
		global $db;

		$error 		= &singleton::get(__NAMESPACE__ . '\error');		
		$log		= &singleton::get(__NAMESPACE__ . '\log');
		$config		= &singleton::get(__NAMESPACE__ . '\config');
		
		$site_id		= SITE_ID;


		$query = "UPDATE $this->table_name SET site_id = :site_id";

		if (isset($array['columns'])) {
			foreach($array['columns'] as $index => $value) {
				if (in_array($index, $this->allowed_columns)) {
					$query .= ', `'.$index.'` = :'.$index;
					unset($index);
					unset($value);
				}
			}
		}	
		
		$query .= " WHERE site_id = :site_id";
		
		if (isset($array['id'])) {
			$query .= " AND id = :id";
		}
		
		if (isset($array['where'])) {
			foreach($array['where'] as $index => $value) {
				if (in_array($index, $this->allowed_columns)) {
					$query .= ' AND `'.$index.'` = :w1'.$index;
					unset($index);
					unset($value);
				}
			}
		}
		
		//echo $query;
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);

		if (isset($array['id'])) {
			$stmt->bindParam(':id', $array['id'], database::PARAM_INT);
		}
		
		if (isset($array['columns'])) {
			foreach($array['columns'] as $index => $value) {
				if (in_array($index, $this->allowed_columns)) {
					$stmt->bindParam(':' . $index, $value);
					unset($index);
					unset($value);
				}
			}
		}
		
		if (isset($array['where'])) {
			foreach($array['where'] as $index => $value) {
				if (in_array($index, $this->allowed_columns)) {
					$stmt->bindParam(':w1' . $index, $value);
					unset($index);
					unset($value);
				}
			}
		}
		
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}				
		
		return true;
	
	}
	public function get($array = NULL) {
		global $db;
		
		$error 			= &singleton::get(__NAMESPACE__ . '\error');
		$tables 		= &singleton::get(__NAMESPACE__ . '\tables');
		$plugins 		= &singleton::get(__NAMESPACE__ . '\plugins');

		$site_id		= SITE_ID;


		$query = "SELECT tan.* ";
		
		if (isset($array['get_other_data']) && ($array['get_other_data'] == true)) {
			$plugins->run('query_table_access_' . $this->base_table_name . '_get_other_data_columns', $query);			
		}
		
		$query .= " FROM $this->table_name tan";
		
		if (isset($array['get_other_data']) && ($array['get_other_data'] == true)) {
			$plugins->run('query_table_access_' . $this->base_table_name . '_get_other_data_join', $query);
		}
		
		$query .= " WHERE 1 = 1 AND tan.site_id = :site_id";
		
		if (isset($array['id'])) {
			$query .= " AND tan.id = :id";
		}
				
		if (isset($array['ids'])) {				
			$return = ' AND tan.id IN (';
			
			foreach ($array['ids'] as $index => $value) {
				$return .= ':id' . (int) $index . ',';
			}
			
			if(substr($return, -1) == ',') {	
				$return = substr($return, 0, strlen($return) - 1);
			}
			
			$return .= ')';
			
			$query .= $return;
		}
		
		if (isset($array['where'])) {
			foreach($array['where'] as $index => $value) {
				if (in_array($index, $this->allowed_columns)) {
					$query .= ' AND tan.' . $index . ' = :'.$index;
					unset($index);
					unset($value);
				}
			}
		}
		
		if (isset($array['like'])) {
			$query .= ' AND (';
			foreach($array['like'] as $index => $value) {
				if (in_array($index, $this->allowed_columns)) {
					$query .= 'tan.' . $index . ' LIKE :'.$index . ' OR ';
					unset($index);
					unset($value);
				}
			}
			
			if(substr($query, -4) == ' OR ') {	
				$query = substr($query, 0, strlen($query) - 4);
			}
			
			$query .= ')';
		}
		
		$query .= " GROUP BY tan.id";

		if (isset($array['order_by']) && in_array($array['order_by'], $this->allowed_columns)) {
			if (isset($array['order']) && $array['order'] == 'desc') {
				$query .= ' ORDER BY tan.' . $array['order_by'] . ' DESC';
			}
			else {
				$query .= ' ORDER BY tan.' . $array['order_by'] . '';
			}			
		}
		else {
			if (isset($array['order']) && $array['order'] == 'asc') {
				$query .= ' ORDER BY tan.id';
			}
			else {
				$query .= " ORDER BY tan.id DESC";
			}	
		}
		
		
		if (isset($array['limit'])) {
			$query .= " LIMIT :limit";
			if (isset($array['offset'])) {
				$query .= " OFFSET :offset";
			}
		}
			
		//echo $query;
			
		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
				
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);

	
		if (isset($array['id'])) {
			$stmt->bindParam(':id', $array['id'], database::PARAM_INT);
		}
		if (isset($array['ids'])) {	
			foreach ($array['ids'] as $index => $value) {
				$r_id = (int) $value;
				$stmt->bindParam(':id' . (int) $index, $r_id, database::PARAM_INT);
				unset($r_id);
			}
		}
		
		if (isset($array['where'])) {
			foreach($array['where'] as $index => $value) {
				if (in_array($index, $this->allowed_columns)) {
					$stmt->bindParam(':' . $index, $value);
					unset($index);
					unset($value);
				}
			}
		}

		if (isset($array['like'])) {
			foreach($array['like'] as $index => $value) {
				if (in_array($index, $this->allowed_columns)) {
					$value = "%{$value}%";
					$stmt->bindParam(':' . $index, $value);
					unset($value);
					unset($index);
				}
			}
		}
		
		if (isset($array['limit'])) {
			$limit = (int) $array['limit'];
			if ($limit < 0) $limit = 0;
			$stmt->bindParam(':limit', $limit, database::PARAM_INT);
			if (isset($array['offset'])) {
				$offset = (int) $array['offset'];
				$stmt->bindParam(':offset', $offset, database::PARAM_INT);					
			}
		}	
	
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$items = $stmt->fetchAll(database::FETCH_ASSOC);
		
		return $items;
	}
	
	function delete($array) {
		global $db;
		
		$tables =	&singleton::get(__NAMESPACE__ . '\tables');
		$error 	=	&singleton::get(__NAMESPACE__ . '\error');

		$site_id	= SITE_ID;
				
		//delete ticket
		$query 	= "DELETE FROM $this->table_name WHERE site_id = :site_id";
		
		if (isset($array['columns'])) {
			foreach($array['columns'] as $index => $value) {
				if (in_array($index, $this->allowed_columns)) {
					$query .= ' AND `'.$index.'` = :'.$index;
					unset($index);
					unset($value);
				}
			}
		}
		
		if (isset($array['id'])) {
			$query .= " AND id = :id";
		}
		
		//echo $query;
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);

		if (isset($array['id'])) {
			$stmt->bindParam(':id', $array['id'], database::PARAM_INT);
		}
		
		if (isset($array['columns'])) {
			foreach($array['columns'] as $index => $value) {
				if (in_array($index, $this->allowed_columns)) {
					$stmt->bindParam(':' . $index, $value);
					unset($index);
					unset($value);
				}
			}
		}
		
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}

	}
	
	public function count($array = NULL) {
		global $db;
		
		$error 			= &singleton::get(__NAMESPACE__ . '\error');
		$tables 		= &singleton::get(__NAMESPACE__ . '\tables');
		$site_id		= SITE_ID;


		$query = "SELECT count(*) AS `count` ";
				
		$query .= " FROM $this->table_name";
		
		$query .= " WHERE 1 = 1 AND site_id = :site_id";
		
		if (isset($array['id'])) {
			$query .= " AND id = :id";
		}
		
		if (isset($array['where'])) {
			foreach($array['where'] as $index => $value) {
				if (in_array($index, $this->allowed_columns)) {
					$query .= ' AND `'.$index.'` = :'.$index;
					unset($index);
					unset($value);
				}
			}
		}
		
		if (isset($array['like'])) {
			$query .= ' AND (';
			foreach($array['like'] as $index => $value) {
				if (in_array($index, $this->allowed_columns)) {
					$query .= '`' . $index . '` LIKE :'.$index . ' OR ';
					unset($index);
					unset($value);
				}
			}
			
			if(substr($query, -4) == ' OR ') {	
				$query = substr($query, 0, strlen($query) - 4);
			}
			
			$query .= ')';
		}
			
		//echo $query;
			
		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);

	
		if (isset($array['id'])) {
			$stmt->bindParam(':id', $array['id'], database::PARAM_INT);
		}
		
		if (isset($array['where'])) {
			foreach($array['where'] as $index => $value) {
				if (in_array($index, $this->allowed_columns)) {
					$stmt->bindParam(':' . $index, $value);
					unset($index);
					unset($value);
				}
			}
		}

		if (isset($array['like'])) {
			foreach($array['like'] as $index => $value) {
				if (in_array($index, $this->allowed_columns)) {
					$value = "%{$value}%";
					$stmt->bindParam(':' . $index, $value);
					unset($value);
					unset($index);
				}
			}
		}
	
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$count = $stmt->fetch(database::FETCH_ASSOC);
		
		return (int) $count['count'];

	}
	
}


?>