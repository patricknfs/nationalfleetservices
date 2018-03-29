<?php
class Banner{
	var $dbObj;
	
	function Banner(){ // class constructor
		$this->dbObj = new DB();
		$this->dbObj->fun_db_connect();
	}
	
	function processBanner($banID=0, $actionMode='ADD'){
		if($banID==""){
			$banID = 0;
		}
		
		$bannArray = array(
						"company_url" => $_POST['company_url'],
						"start_date" => $_POST['start_date'],
						"end_date" => $_POST['end_date'],
						"last_modified_date" => date("Y-m-d H:i:s")
					);
				
		/*=====================================Image Uplaoding Code=============================================*/
		$imageFname = $_FILES['company_banner']['name'];
		$imageTmpName = $_FILES['company_banner']['tmp_name'];
		$imageType = $_FILES['company_banner']['type'];
		
		$thumbAction = (int)$_POST['thumbChangeAction'];
		$thumb_old = trim($_POST['thumb_old']);
		$thumb_type = trim($_POST['thumb_type']);
		// delete this thumbnail
		if($thumbAction==2 || $thumbAction==3){
			if($thumb_old!=""){
				if(file_exists(SITE_DEALER_LOGOS_WS.$thumb_old)){
					@chmod(SITE_DEALER_LOGOS_WS.$thumb_old, 0777);
					@unlink(SITE_DEALER_LOGOS_WS.$thumb_old);
				}
			}
		}
		// delete this thumbnail
		
		if(is_uploaded_file($imageTmpName)){
			$saveImgpath = SITE_DEALER_LOGOS_WS . $imageFname;
			if(!move_uploaded_file($imageTmpName, $saveImgpath)){
				echo "<font color=\"#FF0000\"><b>Error: Could not upload file. Please Try again</b></font><br>Press back button<br>";
				echo "<input type='button' name='backBttn' name='backBtn' onClick='javascript: history.go(-1);'>";
				die();
			}
			$ImgthumbFile = $imageFname;
		}else{
			if($thumbAction==2 || $thumbAction==3){
				$ImgthumbFile = "";
				$imageType = '';
			}else{
				$ImgthumbFile = $thumb_old;
				$imageType = $thumb_type;
			}
		}
		$bannArray['company_banner'] = $ImgthumbFile;
		$bannArray['company_banner_type'] = $imageType;
		/*=====================================Image Uplaoding Code End=============================================*/				
		
		
		if($actionMode=='EDIT'){
			
			$fields = "";
			$fieldsVal = "";
			foreach($bannArray as $keys => $vals){
				$fields .= $keys . "='" . fun_db_input($vals). "', ";
			}
			$fields = trim($fields);
			if($fields!=""){
				$fields = substr($fields,0,strlen($fields)-1);
				$sqlUpdate = "UPDATE " . TABLE_BANNER . " SET " . $fields . " WHERE banner_id='".(int)$banID."'";
				$this->dbObj->fun_db_query($sqlUpdate) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On Category table.</font>");
				return $this->dbObj->fun_db_get_affected_rows();
			}
		}
		
		if($actionMode=='ADD'){
			$fields = "";
			$fieldsVal = "";
			foreach($bannArray as $keys => $vals){
				$fields .= $keys . ", ";
				$fieldsVal .= "'" . fun_db_input($vals). "', ";
			}
			$sqlInsert = "INSERT INTO " . TABLE_BANNER . "(banner_id, ".$fields." added_date) " ;
			$sqlInsert .= " VALUES(null, ".$fieldsVal." '".date("Y-m-d H:i:s")."')";
			$this->dbObj->fun_db_query($sqlInsert) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On Category table.</font>");
			return $this->dbObj->fun_db_get_affected_rows();
		}
	}
	
	function funGetBannerInfo($banID){
		$bannArray = array();
		$sql = "SELECT * FROM " . TABLE_BANNER . " WHERE banner_id='".(int)$banID."'";
		
		$result = $this->dbObj->fun_db_query($sql) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On Banner table.</font>");
		if(!$result || $this->dbObj->fun_db_get_num_rows($result) < 1){
			return; // user does not exists
		}
		$rowsCategory =  $this->dbObj->fun_db_fetch_rs_object($result);
		$bannArray = array(
							"banner_id" => fun_db_output($rowsCategory->banner_id),
							"company_url" => fun_db_output($rowsCategory->company_url),
							"company_banner" => fun_db_output($rowsCategory->company_banner),
							"company_banner_type" => fun_db_output($rowsCategory->company_banner_type),
							"start_date" => fun_db_output($rowsCategory->start_date),
							"end_date" => fun_db_output($rowsCategory->end_date),
							"last_modified_date" => fun_db_output($rowsCategory->last_modified_date),
							"added_date" => fun_db_output($rowsCategory->added_date)
						 );
		return $bannArray;
	}
	
	function funDeleteBanner($banID){
	
		$sql = "DELETE FROM " . TABLE_BANNER . " WHERE banner_id='".(int)$banID."'";
		$result = $this->dbObj->fun_db_query($sql) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On Banner table.</font>");
		return;
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