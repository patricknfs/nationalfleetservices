<?php
class Offers{
	var $dbObj;
	
	function Offers(){ // class constructor
		$this->dbObj = new DB();
		$this->dbObj->fun_db_connect();
	}
	
	function processOffers($ofrID=0, $actionMode='ADD'){
		if($ofrID==""){
			$ofrID = 0;
		}
		/*--------------------------------Store all form fields in an Array--------------------------------------*/
		$ofrArray = array(
						"offer_title" => $_POST['offer_title'],
						"dealer_id" => $_POST['dealer_id'],
						"make_id" => $_POST['make_id'],
						"model_id" => $_POST['model_id'],
						"finance_type" => $_POST['finance_type'],
						"offer_varient" => $_POST['offer_varient'],
						"offer_details" => $_POST['offer_details'],
						"offer_price" => $_POST['offer_price'],
						"price_type" => $_POST['price_type'],
			            "offer_link" => $_POST['offer_link'],
						"offer_feature" => $_POST['offer_feature'],
						"offer_status" => $_POST['offer_status'],
						"offer_auto_renew" =>  $_POST['offer_auto_renew'],
						"last_modified_date" => date("Y-m-d H:i:s")
					);
		/*=====================================Image Uplaoding Code=============================================*/
		$imageFname = $_FILES['offer_image']['name'];
		$imageTmpName = $_FILES['offer_image']['tmp_name'];
		$imageType = $_FILES['offer_image']['type'];
		
		$thumbAction = (int)$_POST['thumbChangeAction'];
		$thumb_old = trim($_POST['thumb_old']);
		
		// delete this thumbnail
		if($thumbAction==2 || $thumbAction==3){
			if($thumb_old!=""){
				if(file_exists(SITE_OFFERS_IMAGES_WS.$thumb_old)){
					@chmod(SITE_OFFERS_IMAGES_WS.$thumb_old, 0777);
					@unlink(SITE_OFFERS_IMAGES_WS.$thumb_old);
				}
			}
		}
		// delete this thumbnail
		
		if(is_uploaded_file($imageTmpName)){
			$saveImgpath = SITE_OFFERS_IMAGES_WS . $imageFname;
			if(!move_uploaded_file($imageTmpName, $saveImgpath)){
				echo "<font color=\"#FF0000\"><b>Error: Could not upload Image. Please Try again</b></font><br>Press back button<br>";
				echo "<input type='button' name='backBttn' name='backBtn' onClick='javascript: history.go(-1);'>";
				die();
			}
			$ImgthumbFile = $imageFname;
		}else{
			if($thumbAction==2 || $thumbAction==3){
				 $ImgthumbFile = "";
			}else{
			     $ImgthumbFile = $thumb_old;
			}
		}
		
		$ofrArray['offer_image'] = $ImgthumbFile;
		/*=====================================Image Uplaoding Code End=============================================*/		
		/*=====================================Modifying Offers Code=============================================*/
		if($actionMode=='EDIT'){
			
			$fields = "";
			$fieldsVal = "";
			foreach($ofrArray as $keys => $vals){
				$fields .= $keys . "='" . fun_db_input($vals). "', ";
			}
			$fields = trim($fields);
			if($fields!=""){
				$fields = substr($fields,0,strlen($fields)-1);
				$sqlUpdate = "UPDATE " . TABLE_OFFERS . " SET " . $fields . " WHERE offer_id='".(int)$ofrID."'";
				//echo $sqlUpdate;
				$this->dbObj->fun_db_query($sqlUpdate) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On offer table.</font>");
				return $this->dbObj->fun_db_get_affected_rows();
			}
		}
		/*=====================================Modifying offers Code End=============================================*/
		/*=====================================Add New offer Code ==================================================*/
		if($actionMode=='ADD'){
			$fields = "";
			$fieldsVal = "";
			foreach($ofrArray as $keys => $vals){
				$fields .= $keys . ", ";
				$fieldsVal .= "'" . fun_db_input($vals). "', ";
			}
			$sqlInsert = "INSERT INTO " . TABLE_OFFERS . "(offer_id, ".$fields." added_date) " ;
			$sqlInsert .= " VALUES(null, ".$fieldsVal." '".date("Y-m-d H:i:s")."')";
			$this->dbObj->fun_db_query($sqlInsert) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On offer table.</font>");
			return $this->dbObj->fun_db_get_affected_rows();
		}
		/*=====================================Add New offer Code end===========================================*/
	}//Function processOffers() ends.
	
	function funGetOfferInfo($ofrID){
		$ofrArray = array();
		$sql = "SELECT * FROM " . TABLE_OFFERS . " WHERE offer_id='".(int)$ofrID."'";
		
		$result = $this->dbObj->fun_db_query($sql) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On Product table.</font>");
		if(!$result || $this->dbObj->fun_db_get_num_rows($result) < 1){
			return; // user does not exists
		}
		$rowsOffer =  $this->dbObj->fun_db_fetch_rs_object($result);
		$ofrArray = array(
							"offer_id" => fun_db_output($rowsOffer->offer_id),
							"offer_title" => fun_db_output($rowsOffer->offer_title),
							"dealer_id" => fun_db_output($rowsOffer->dealer_id),
							"make_id" => fun_db_output($rowsOffer->make_id),
							"model_id" => fun_db_output($rowsOffer->model_id),
							"finance_type" => fun_db_output($rowsOffer->finance_type),
							"offer_image" =>  fun_db_output($rowsOffer->offer_image),
							"offer_varient" => fun_db_output($rowsOffer->offer_varient),
							"offer_details" => fun_db_output($rowsOffer->offer_details),
							"offer_price" => fun_db_output($rowsOffer->offer_price),
							"price_type" => fun_db_output($rowsOffer->price_type),
							"offer_link" => fun_db_output($rowsOffer->offer_link),
							"offer_feature" => fun_db_output($rowsOffer->offer_feature),
			                "offer_status" => fun_db_output($rowsOffer->offer_status),
							"offer_auto_renew" => fun_db_output($rowsOffer->offer_auto_renew),
							"last_modified_date" => fun_db_output($rowsOffer->last_modified_date),
							"added_date" => fun_db_output($rowsOffer->added_date)
						 );
		return $ofrArray;
	}//Function Offer info ens.
		
	function fun_MakeOptions($dlID=0){
		$selected = "";
		
		$sql = trim($sql);
		$sql = "SELECT DISTINCT make_id,CategoryName FROM " . TABLE_OFFERS . " AS s JOIN ukchl_categorymaster AS c ON s.make_id = c.sno WHERE dealer_id='".(int)$dlID."'";
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
			echo "<option value=\"".fun_db_output($rows->make_id)."\" " .$selected. ">";
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