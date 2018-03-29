<?php
class Members{
	var $dbObj;
	
	function Members(){ // class constructor
		$this->dbObj = new DB();
		$this->dbObj->fun_db_connect();
	} 
	
	function fun_getMembersInfo($memID=0, $memEmail=''){
		$membersArray = array();
		
		$sql = "SELECT * FROM " . TABLE_MEMBERS . " WHERE ";
		if($memEmail!=""){
			$sql .= "member_email_id='".fun_db_input($memEmail)."' ";
		}else{
			$sql .= "member_id='".(int)fun_db_input($memID)."' ";
		}
		$result = $this->dbObj->fun_db_query($sql);
		if($this->dbObj->fun_db_get_num_rows($result) > 0){
			$rowsArray = $this->dbObj->fun_db_fetch_rs_object($result);
			$membersArray['member_id'] = fun_db_output($rowsArray->member_id);
			$membersArray['member_email_id'] = fun_db_output($rowsArray->member_email_id);
			$membersArray['member_password'] = fun_db_output($rowsArray->member_password);
			$membersArray['member_title'] = fun_db_output($rowsArray->member_title);
			$membersArray['member_fname'] = fun_db_output($rowsArray->member_fname);
			$membersArray['member_lname'] = fun_db_output($rowsArray->member_lname);
			$membersArray['member_address_1'] = fun_db_output($rowsArray->member_address_1);
			$membersArray['member_address_2'] = fun_db_output($rowsArray->member_address_2);
			$membersArray['member_city'] = fun_db_output($rowsArray->member_city);
			$membersArray['member_state'] = fun_db_output($rowsArray->member_state);
			$membersArray['member_pincode'] = fun_db_output($rowsArray->member_pincode);
			$membersArray['country_id'] = fun_db_output($rowsArray->country_id);
			$membersArray['member_dob'] = fun_db_output($rowsArray->member_dob);
			$membersArray['member_sex'] = fun_db_output($rowsArray->member_sex);
			$membersArray['member_phone'] = fun_db_output($rowsArray->member_phone);
			$membersArray['member_fax'] = fun_db_output($rowsArray->member_fax);
			$membersArray['member_status'] = fun_db_output($rowsArray->member_status);
			$membersArray['member_last_modified'] = fun_db_output($rowsArray->member_last_modified);
			$membersArray['member_added_date'] = fun_db_output($rowsArray->member_added_date);
		}
		$this->dbObj->fun_db_free_resultset($result);
		return $membersArray ;
	}
	
	function fun_addNewMember($memID=0, $actionType='ADD'){
		$dobDay = trim($_POST['dobDay']);
		$dobMonth = trim($_POST['dobMonth']);
		$dobYear = trim($_POST['dobYear']);
		$memberDob = "";
		if($dobDay!='' && $dobMonth!='' && $dobYear!=''){
			$memberDob = $dobYear . "-" . $dobMonth . "-" .$dobDay;
		}
		$membersArray = array(
							"member_email_id" => $_POST['member_email_id'],
							"member_password" => $_POST['member_password'],
							"member_title" => $_POST['member_title'],
							"member_fname" => $_POST['member_fname'],
							"member_lname" => $_POST['member_lname'],
							"member_address_1" => $_POST['member_address_1'],
							"member_address_2" => $_POST['member_address_2'],
							"member_city" => $_POST['member_city'],
							"member_state" => $_POST['member_state'],
							"country_id" => $_POST['country_id'],
							"member_pincode" => $_POST['member_pincode'],
							"member_sex" => $_POST['member_sex'],
							"member_dob" => $memberDob,
							"member_phone" => $_POST['member_phone'],
							"member_fax" => $_POST['member_fax'],
							"member_last_modified" => date("Y-m-d H:i:s")
						);
		if($actionType=='EDIT'){
			$membersArray['member_status'] = $_POST['member_status'];
			$fields = "";
			$fieldsVal = "";
			foreach($membersArray as $keys => $vals){
				$fields .= $keys . "='" . fun_db_input($vals). "', ";
			}
			$fields = trim($fields);
			if($fields!=""){
				$fields = substr($fields,0,strlen($fields)-1);
				$sqlUpdate = "UPDATE " . TABLE_MEMBERS . " SET " . $fields . " WHERE member_id='".(int)$memID."'";
				$this->dbObj->fun_db_query($sqlUpdate) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On Member table.</font>");
				return $this->dbObj->fun_db_get_affected_rows();
			}
		}
		if($actionType=='ADD'){
			$fields = "";
			$fieldsVals = "";
			$cnt = 0;
			foreach($membersArray as $keys => $values){
				$fields .= $keys;
				$fieldsVals .= "'" . fun_db_input($values) . "'";
				if($cnt < sizeof($membersArray)-1){
					$fields .= ", ";
					$fieldsVals .= ", ";
				}
				$cnt++;
			}
			$sqlInsert = "INSERT INTO " . TABLE_MEMBERS . "(member_id, ".$fields.", member_added_date) ";
			$sqlInsert .= "VALUES(null, ".$fieldsVals.", '".date("Y-m-d H:i:s")."')";
	
			$this->dbObj->fun_db_query($sqlInsert) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On Member table.</font>");
			return $this->dbObj->fun_db_get_affected_rows();
		}
	}
	
	function fun_checkEmailAddress($emailID, $memID=0){
		$emailFound = false;
		$sqlCheck = "SELECT member_email_id FROM " . TABLE_MEMBERS . " WHERE member_email_id='".fun_db_input($emailID)."' ";
		if($memID !="" && $memID > 0){
			$sqlCheck .= " AND member_id<>'".fun_db_input($memID)."'";
		}
		if($this->fun_get_num_rows($sqlCheck) > 0){
			$emailFound = true;
		}
		return $emailFound;
	}
	
	function fun_verifyMember($emailID, $pass){
		$memFound = false;
		$sqlCheck = "SELECT member_email_id FROM " . TABLE_MEMBERS . " WHERE member_email_id='".fun_db_input($emailID)."' ";
		$sqlCheck .= " AND member_password='".fun_db_input($pass)."'";
		if($this->fun_get_num_rows($sqlCheck) > 0){
			$memFound = true;
		}
		return $memFound;
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