<?php
class Models{
	var $dbObj;
	
	function Models(){ // class constructor
		$this->dbObj = new DB();
		$this->dbObj->fun_db_connect();
	}
	
	function processOffers($mdlID=0, $actionMode='ADD'){
		if($mdlID==""){
			$mdlID = 0;
		}
		/*--------------------------------Store all form fields in an Array--------------------------------------*/
		$mdlArray = array(
						"CatID" => $_POST['CatID'],
						"SubCatName" => $_POST['SubCatName'],
						"Descriptions" => $_POST['Descriptions'],
						"FullImage" => $_POST['FullImage'],
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
			foreach($mdlArray as $keys => $vals){
				$fields .= $keys . "='" . fun_db_input($vals). "', ";
			}
			$fields = trim($fields);
			if($fields!=""){
				$fields = substr($fields,0,strlen($fields)-1);
				$sqlUpdate = "UPDATE " . TABLE_MODELS . " SET " . $fields . " WHERE sno='".(int)$mdlID."'";
				$this->dbObj->fun_db_query($sqlUpdate) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On Product table.</font>");
				return $this->dbObj->fun_db_get_affected_rows();
			}
		}
		/*=====================================Modifying offers Code End=============================================*/
		/*=====================================Add New offer Code ==================================================*/
		if($actionMode=='ADD'){
			$fields = "";
			$fieldsVal = "";
			foreach($mdlArray as $keys => $vals){
				$fields .= $keys . ", ";
				$fieldsVal .= "'" . fun_db_input($vals). "', ";
			}
			$sqlInsert = "INSERT INTO " . TABLE_MODELS . "(sno, ".$fields." EntryDate) " ;
			$sqlInsert .= " VALUES(null, ".$fieldsVal." '".date("Y-m-d H:i:s")."')";
			$this->dbObj->fun_db_query($sqlInsert) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On Product table.</font>");
			return $this->dbObj->fun_db_get_affected_rows();
		}
		/*=====================================Add New offer Code end===========================================*/
	}//Function processOffers() ends.
	
	function funGetModelInfo($mdlID){
		$mdlArray = array();
		$sql = "SELECT * FROM " . TABLE_MODELS . " WHERE sno='".(int)$mdlID."'";
		
		$result = $this->dbObj->fun_db_query($sql) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On Product table.</font>");
		if(!$result || $this->dbObj->fun_db_get_num_rows($result) < 1){
			return; // user does not exists
		}
		$rows =  $this->dbObj->fun_db_fetch_rs_object($result);
		$mdlArray = array(
							"sno" => fun_db_output($rows->sno),
							"CatID" => fun_db_output($rows->CatID),
							"SubCatName" => fun_db_output($rows->SubCatName),
							"Descriptions" => fun_db_output($rows->Descriptions),
							"FullImage" => fun_db_output($rows->FullImage),
							"EntryDate" =>  fun_db_output($rows->EntryDate),
						 );
		return $mdlArray;
	}//Function model info ends.
		
	function fun_ModelsOptions($mdlID=''){
		$selected = "";
		
		$sql = trim($sql);
		$sql = "SELECT * FROM " . TABLE_MODELS;
		$result = $this->dbObj->fun_db_query($sql);
		while($rows = $this->dbObj->fun_db_fetch_rs_object($result)){
			if($rows->sno == $mdlID  && $mdlID!=''){
				$selected = "selected";
			}else{
				$selected = "";
			}
			echo "<option value=\"".fun_db_output($rows->sno)."\" " .$selected. ">";
			echo fun_db_output($rows->SubCatName);
			echo "</option>\n";
		}
		$this->dbObj->fun_db_free_resultset($result);
	}
	
	function funModelJavascriptCode(){
		$sql = "SELECT * FROM " . TABLE_MODELS . " ORDER BY SubCatName";
		$rsMdl = $this->dbObj->fun_db_query($sql);
		$cnt = 0;
		while($rows = $this->dbObj->fun_db_fetch_rs_object($rsMdl)){
			echo " MDArray[".$cnt ."] = new Array(".(int)$rows->sno.", \"".fun_db_output($rows->SubCatName)."\", ".(int)$rows->CatID.");";
			echo "\n";
			$cnt++;
		}
		$this->dbObj->fun_db_free_resultset($rsMdl);
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