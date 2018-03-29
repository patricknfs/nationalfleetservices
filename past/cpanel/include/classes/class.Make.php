<?php
class Make{
	var $dbObj;
	
	function Make(){ // class constructor
		$this->dbObj = new DB();
		$this->dbObj->fun_db_connect();
	}
	
	function processMake($mkID=0, $actionMode='ADD'){
		if($mkID==""){
			$mkID = 0;
		}
		/*--------------------------------Store all form fields in an Array--------------------------------------*/
		$mkArray = array(
						"CategoryName" => $_POST['CategoryName'],
						"vehicle_type" => $_POST['vehicle_type'],
						"Descriptions" => $_POST['Descriptions'],
						"FullImage" => $_FILES['FullImage'],
						);
		/*=====================================Image Uplaoding Code=============================================*/
		$imageFname = $_FILES['FullImage']['name'];
		$imageTmpName = $_FILES['FullImage']['tmp_name'];
		$imageType = $_FILES['FullImage']['type'];
		
		if(is_uploaded_file($imageTmpName)){
			$saveImgpath = SITE_IMAGES_CATEGORY_WS . $imageFname;
			if(!move_uploaded_file($imageTmpName, $saveImgpath)){
				echo "<font color=\"#FF0000\"><b>Error: Could not upload Image. Please Try again</b></font><br>Press back button<br>";
				echo "<input type='button' name='backBttn' name='backBtn' onClick='javascript: history.go(-1);'>";
				die();
			}
		}
		/*=====================================Image Uplaoding Code End=============================================*/		
		/*=====================================Modifying Offers Code=============================================*/
		if($actionMode=='EDIT'){
			
			$fields = "";
			$fieldsVal = "";
			foreach($mkArray as $keys => $vals){
				$fields .= $keys . "='" . fun_db_input($vals). "', ";
			}
			$fields = trim($fields);
			if($fields!=""){
				$fields = substr($fields,0,strlen($fields)-1);
				$sqlUpdate = "UPDATE " . TABLE_MAKES . " SET " . $fields . " WHERE sno='".(int)$mkID."'";
				$this->dbObj->fun_db_query($sqlUpdate) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On table.</font>");
				return $this->dbObj->fun_db_get_affected_rows();
			}
		}
		/*=====================================Modifying offers Code End=============================================*/
		/*=====================================Add New offer Code ==================================================*/
		if($actionMode=='ADD'){
			$fields = "";
			$fieldsVal = "";
			foreach($mkArray as $keys => $vals){
				$fields .= $keys . ", ";
				$fieldsVal .= "'" . fun_db_input($vals). "', ";
			}
			$sqlInsert = "INSERT INTO " . TABLE_MAKES . "(sno, ".$fields." EntryDate) " ;
			$sqlInsert .= " VALUES(null, ".$fieldsVal." '".date("Y-m-d H:i:s")."')";
			$this->dbObj->fun_db_query($sqlInsert) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On table.</font>");
			return $this->dbObj->fun_db_get_affected_rows();
		}
		/*=====================================Add New offer Code end===========================================*/
	}//Function processOffers() ends.
	
	function funGetMakeInfo($mkID){
		$mkArray = array();
		$sql = "SELECT * FROM " . TABLE_MAKES . " WHERE sno='".(int)$mkID."'";
		
		$result = $this->dbObj->fun_db_query($sql) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On table.</font>");
		if(!$result || $this->dbObj->fun_db_get_num_rows($result) < 1){
			return; // user does not exists
		}
		$rows =  $this->dbObj->fun_db_fetch_rs_object($result);
		$mkArray = array(
							"sno" => fun_db_output($rows->sno),
							"CategoryName" => fun_db_output($rows->CategoryName),
							"vehicle_type" => fun_db_output($rows->vehicle_type),
							"Descriptions" => fun_db_output($rows->Descriptions),
							"FullImage" => fun_db_output($rows->FullImage),
							"EntryDate" => fun_db_output($rows->EntryDate)
						 );
		return $mkArray;
	}//Function Offer info ens.
	
	function funMakeJavascriptCode(){
		$sql = "SELECT * FROM " . TABLE_MAKES . " ORDER BY CategoryName";
		$rsMdl = $this->dbObj->fun_db_query($sql);
		$cnt = 0;
		while($rows = $this->dbObj->fun_db_fetch_rs_object($rsMdl)){
			echo " MKArray[".$cnt ."] = new Array(".(int)$rows->sno.", \"".fun_db_output($rows->CategoryName)."\", \"".fun_db_output($rows->vehicle_type)."\");";
			echo "\n";
			$cnt++;
		}
		$this->dbObj->fun_db_free_resultset($rsMdl);
	}
		
	function fun_MakeOptionsInAdmin($mkID=0){
		$selected = "";
		
		$sql = trim($sql);
		$sql = "SELECT * FROM " . TABLE_MAKES;
		$result = $this->dbObj->fun_db_query($sql);
		while($rows = $this->dbObj->fun_db_fetch_rs_object($result)){
			if($rows->sno == $mkID  && $mkID!=''){
				$selected = "selected";
			}else{
				$selected = "";
			}
			if($rows->vehicle_type == 1){
				$vtype = "car";
			}else{
				$vtype = "van";
			}
			echo "<option value=\"".fun_db_output($rows->sno)."\" " .$selected. ">";
			echo fun_db_output($rows-> CategoryName)." ".$vtype;
			echo "</option>\n";
		}
		$this->dbObj->fun_db_free_resultset($result);
	}
	function fun_MakeOptions($mkID=0){
		$selected = "";
		
		$sql = trim($sql);
		$sql = "SELECT * FROM " . TABLE_MAKES." ORDER BY CategoryName";
		if($sess != ''){
			//$sql.=" WHERE dealer_id=".(int)$sess;
		}
		$result = $this->dbObj->fun_db_query($sql);
		while($rows = $this->dbObj->fun_db_fetch_rs_object($result)){
			if($rows->sno == $mkID  && $mkID!=''){
				$selected = "selected";
			}else{
				$selected = "";
			}
			echo "<option value=\"".fun_db_output($rows->sno)."\" " .$selected. ">";
			echo fun_db_output($rows-> CategoryName);
			echo "</option>\n";
		}
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