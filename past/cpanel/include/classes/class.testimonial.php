<?php
class Testimonial{
	var $dbObj;
	
	function Testimonial(){ // class constructor
		$this->dbObj = new DB();
		$this->dbObj->fun_db_connect();
	}
	
	function processTestimonial($tstID=0, $actionMode='ADD'){
		if($tstID==""){
			$tstID = 0;
		}
		
		$tstArray = array(
					"testimonial_text" => $_POST['testimonial_text'],
					);
		
		if($actionMode=='EDIT'){
			
			$fields = "";
			$fieldsVal = "";
			foreach($tstArray as $keys => $vals){
				$fields .= $keys . "='" . fun_db_input($vals). "', ";
			}
			$fields = trim($fields);
			if($fields!=""){
				$fields = substr($fields,0,strlen($fields)-1);
				$sqlUpdate = "UPDATE " . TABLE_TESTIMONIAL . " SET " . $fields . " WHERE testimonial_id='".(int)$tstID."'";
				//echo $sqlUpdate;exit;
				$this->dbObj->fun_db_query($sqlUpdate) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On TABLE_TESTIMONIAL table.</font>");
				return $this->dbObj->fun_db_get_affected_rows();
			}
		}
		
		if($actionMode=='ADD'){
			$fields = "";
			$fieldsVal = "";
			foreach($tstArray as $keys => $vals){
				$fields .= $keys . ", ";
				$fieldsVal .= "'" . fun_db_input($vals). "', ";
			}
			$sqlInsert = "INSERT INTO " . TABLE_TESTIMONIAL . "(testimonial_id, ".$fields." added_date) " ;
			$sqlInsert .= " VALUES(null, ".$fieldsVal." '".date("Y-m-d H:i:s")."')";
			//echo $sqlInsert;exit;
			$this->dbObj->fun_db_query($sqlInsert) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On TABLE_TESTIMONIAL table.</font>".mysql_error());
			return $this->dbObj->fun_db_get_affected_rows();
		}
	}
	
	function funGetTestimonialInfo($tstID){
		$tstArray = array();
		$sql = "SELECT * FROM " . TABLE_TESTIMONIAL . " WHERE testimonial_id='".(int)$tstID."'";
		
		$result = $this->dbObj->fun_db_query($sql) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On TABLE_TESTIMONIAL table.</font>".mysql_error());
		if(!$result || $this->dbObj->fun_db_get_num_rows($result) < 1){
			return; // user does not exists
		}
		$rowsTst =  $this->dbObj->fun_db_fetch_rs_object($result);
		$tstArray = array(
							"testimonial_id" => fun_db_output($rowsTst->testimonial_id),
							"testimonial_text" => fun_db_output($rowsTst->testimonial_text),
							"last_modified_date" => fun_db_output($rowsTst->last_modified_date),
							"added_date" => fun_db_output($rowsTst->added_date)
						 );
		return $tstArray;
		$this->dbObj->fun_db_free_resultset($result);
	}
	
	function fun_get_num_rows($sql){
		$totalRows = 0;
		$selected = "";
		$sql = trim($sql);
		if($sql==""){
			die("<font color='#ff0000' face='verdana' face='2'>Error: Query is Empty!</font>");
			exit;
		}
		$result = $this->dbObj->fun_db_query($sql);
		$totalRows = $this->dbObj->fun_db_get_num_rows($result);
		$this->dbObj->fun_db_free_resultset($result);
		return $totalRows;
	}
	
}
?>