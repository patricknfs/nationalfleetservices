<?php
class Users{
	var $dbObj;
	
	function Users(){ // class constructor
		$this->dbObj = new DB();
		$this->dbObj->fun_db_connect();
	}
	
	function fun_users_check_username($username, $userid=''){
		$sql = "SELECT username FROM " . TABLE_USERS . " WHERE username='".fun_db_input($username)."' ";
		$usernameFound = false;
		if($userid!=''){
			$sql .= " AND user_id<>'".(int)$userid."' ";
		}
		if($this->fun_get_num_rows($sql) > 0){
			$usernameFound = true;
		}
		return $usernameFound;
	}
	
	
	
	function fun_users_check_email_id($emailid, $userid=''){
		$sql = "SELECT user_email_id FROM " . TABLE_USERS . " WHERE user_email_id='".fun_db_input($emailid)."' ";
		$emailIDFound = false;
		if($userid!=''){
			$sql .= " AND user_id<>'".(int)$userid."' ";
		}
		if($this->fun_get_num_rows($sql) > 0){
			$emailIDFound = true;
		}
		return $emailIDFound;
	}
	
	function processNewUsers($userDataArray, $userID=0){
		if(!is_array($userDataArray)){
			die("Error: Internal error Occured!");
		}
		$fields = "";
		$fieldsVal = "";
		foreach($userDataArray as $keys => $vals){
			$fields .= $keys . ", ";
			$fieldsVal .= "'". $vals . "', ";
		}
		$fields = trim($fields);
		$fieldsVal = trim($fieldsVal);
		
		$sqlInsert = "INSERT INTO " . TABLE_USERS . "(user_id, ". $fields ." user_added_date) ";
		$sqlInsert .= "VALUES(null, ".$fieldsVal. " '".date("Y-m-d H:i:s")."')";
		$this->dbObj->fun_db_query($sqlInsert);
		$affectedRows = $this->dbObj->fun_db_get_affected_rows();
		if($affectedRows >=0){
			return true;
		}else{
			return false;
		}
	}
	
	function fun_activation_user($username, $activateVal=0){
		$sqlUpdate = "UPDATE " . TABLE_USERS . " SET user_activited='" . (int)$activateVal . "' WHERE username='".fun_db_input($username)."'";
		$this->dbObj->fun_db_query($sqlUpdate);
		$affectedRows = $this->dbObj->fun_db_get_affected_rows();
		if($affectedRows >=0){
			return true;
		}else{
			return false;
		}
	}
	
	function fun_update_user_login_status($userid=0, $username='', $logStatusVal=0){
		$sqlUpdate = "UPDATE " . TABLE_USERS . " SET user_login_status='" . (int)$logStatusVal; 
		if($username == ''){
			$sqlUpdate .= "' WHERE userid='".(int)$userid."'";
		}else{
			$sqlUpdate .= "' WHERE username='".fun_db_input($username)."'";
		}
		
		$this->dbObj->fun_db_query($sqlUpdate);
		$affectedRows = $this->dbObj->fun_db_get_affected_rows();
		if($affectedRows >=0){
			return true;
		}else{
			return false;
		}
	}
	
	function fun_check_login_user(){ // this is used to check login of user if user is valid return true
		if(isset($_COOKIE['cooksitename'])==md5("COOKAJEETMYOMAGNONOINTERNATIONAL")){
			if(isset($_COOKIE['cookuname']) && isset($_COOKIE['cookupass'])){
				$_SESSION['session_user_name'] = $_COOKIE['cookuname'];
				$_SESSION['session_user_pass'] = $_COOKIE['cookupass'];
			}
		}
		if(isset($_SESSION['session_user_name']) && isset($_SESSION['session_user_pass'])){
			if($this->fun_verify_user($_SESSION['session_user_name'], $_SESSION['session_user_pass'])){
				return true;
			}else{
				unset($_SESSION['session_user_name']);
				unset($_SESSION['session_user_pass']);
				return false;
			}
		}else{
			return false;
		}
	}
	
	function fun_verify_user($username, $userpass){ // this function used to verify user in our database that username with give passoward
		$sqlCheck = "SELECT username, password FROM " . TABLE_USERS . " WHERE username='".fun_db_input($username)."'";
		$result = $this->dbObj->fun_db_query($sqlCheck) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!</font>");
		if(!$result || $this->dbObj->fun_db_get_num_rows($result) < 1){
			return false; // user does not exists
		}
		$rowsUser = $this->dbObj->fun_db_fetch_rs_object($result);
		$uPass = md5(fun_db_output($rowsUser->password));
		$this->dbObj->fun_db_free_resultset($result);
		if($uPass == $userpass){
			return true; // user exists
		}else{
			return false; // user does not exists
		}
	}
	
	function fun_get_user_info($userid=0, $username=''){
		$userArray = array();
		$sql = "SELECT * FROM " . TABLE_USERS;
		if($username == ''){
			$sql .= " WHERE user_id='".(int)$userid."'";
		}else{
			$sql .= " WHERE username='".fun_db_input($username)."'";
		}
		$result = $this->dbObj->fun_db_query($sql) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!</font>");
		if($this->dbObj->fun_db_get_num_rows($result) > 0){
			$rowsUser = $this->dbObj->fun_db_fetch_rs_object($result);
			$userArray = array(
							"user_id" => fun_db_output($rowsUser->user_id),
							"username" => fun_db_output($rowsUser->username),
							"password" => fun_db_output($rowsUser->password),
							"user_email_id" => fun_db_output($rowsUser->user_email_id),
							"user_fname" => fun_db_output($rowsUser->user_fname),
							"user_lname" => fun_db_output($rowsUser->user_lname),
							"user_address1" => fun_db_output($rowsUser->user_address1),
							"user_address2" => fun_db_output($rowsUser->user_address2),
							"user_city" => fun_db_output($rowsUser->user_city),
							"user_state" => fun_db_output($rowsUser->user_state),
							"country_id" => fun_db_output($rowsUser->country_id),
							"user_mobile_phone" => fun_db_output($rowsUser->user_mobile_phone),
							"user_gender" => fun_db_output($rowsUser->user_gender),
							"user_dob" => fun_db_output($rowsUser->user_dob),
							"user_webpage_url" => fun_db_output($rowsUser->user_webpage_url),
							"user_cpu" => fun_db_output($rowsUser->user_cpu),
							"user_computer_ram" => fun_db_output($rowsUser->user_computer_ram),
							"user_video_card" => fun_db_output($rowsUser->user_video_card),
							"user_mouse" => fun_db_output($rowsUser->user_mouse),
							"user_isp_connection" => fun_db_output($rowsUser->user_isp_connection),
							"user_preference" => fun_db_output($rowsUser->user_preference),
							"user_image_verification_code" => fun_db_output($rowsUser->user_image_verification_code),
							"user_email_varification_code" => fun_db_output($rowsUser->user_email_varification_code),
							"user_tag_line" => fun_db_output($rowsUser->user_tag_line),
							"user_login_status" => fun_db_output($rowsUser->user_login_status),
							"user_activited" => fun_db_output($rowsUser->user_activited),
							"user_logged_in_status" => fun_db_output($rowsUser->user_logged_in_status),
							"user_last_login" => fun_db_output($rowsUser->user_last_login),
							"user_added_date" => fun_db_output($rowsUser->user_added_date)
						 );			
		}
		$this->dbObj->fun_db_free_resultset($result);
		return $userArray;
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