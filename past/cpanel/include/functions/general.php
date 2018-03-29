<?php
function redirectURL($rurl){
	header("Location: " . $rurl);
	exit;
}
function fun_db_output($str){
	return stripslashes($str);
}
function fun_db_input($str){
	$str = trim($str);
	if(!get_magic_quotes_gpc()){
		return addslashes($str);
	}else{
		return $str;
	}
}

function fun_get_commas_values($str){ // if ,4,2,3,6, will be converted to 4,2,3,6
	$newStr = "";
	$str = trim($str);
	if(str!="" && strlen($str) > 2){
		$newStr = substr($str,1,strlen($str)-2);
	}
	return $newStr;
}

function fun_site_date_format($strDate){
	$dateFormat = "";
	if($strDate!=""){
		$dateFormat = date("d M, Y", strtotime($strDate));
	}
	return $dateFormat;
}

function fun_currency_format($curr=0){
	return number_format($curr, 2);
}
function fun_check_date($yyyy, $mm, $dd){
	$dateCode = array();
	if($mm < 1 || $mm > 12){
		$dateCode['code'] = false;
		$dateCode['codemsg'] = "The month date must be between 1 and 12!";
		return $dateCode;
	}
	if($dd < 1 || $dd > 31){
		$dateCode['code'] = false;
		$dateCode['codemsg'] = "The day date must be between 1 and 31!";
		return $dateCode;
	}
	if($dd==31 && ($mm==4 || $mm==6 || $mm==9 || $mm==11)){
		$dateCode['code'] = false;
		$dateCode['codemsg'] = "The month for your date doesn't have 31 days!";
		return $dateCode;
	}
	if($mm==2){
		$learYear = false;
		if($yyyy % 4 == 0 && ($yyyy % 100 != 0 || $yyyy % 400 == 0)){
			$learYear = true;
		}
		if($dd > 29 || ($dd==29 && !$learYear)){
			$dateCode['code'] = false;
			$dateCode['codemsg'] = "The month for your date doesn't have ".$dd." days for year ".$yyyy."!";
			return $dateCode;
		}
	}
	$dateCode['code'] = true;
	$dateCode['codemsg'] = "";
	return $dateCode;
}
function fun_create_number_options($startVal=0, $endVal=0, $incr=1, $selVal=''){
	$selected = "";
	$incr = (int)$incr;
	for($i=$startVal; $i <= $endVal; $i=$i+$incr){
		if($i == $selVal && $selVal!=''){
			$selected = " selected";
		}else{
			$selected = "";
		}
		echo "<option value=\"".$i."\" ".$selected.">" . $i ." months". "</option>\n";
	}
}
function fun_created_month_option($selVal=''){
	$monthsArray = array();
	$monthsArray['1'] = "January";
	$monthsArray['2'] = "February";
	$monthsArray['3'] = "March";
	$monthsArray['4'] = "April";
	$monthsArray['5'] = "May";
	$monthsArray['6'] = "June";
	$monthsArray['7'] = "July";
	$monthsArray['8'] = "August";
	$monthsArray['9'] = "September";
	$monthsArray['10'] = "October";
	$monthsArray['11'] = "November";
	$monthsArray['12'] = "December";
	foreach($monthsArray as $keys => $vals){
		if($keys == $selVal){
			$selected = " selected";
		}else{
			$selected = "";
		}
		echo "<option value=\"".$keys."\" ".$selected.">" . $vals . "</option>\n";
	}
}

function fun_getFileContent($fileName){
	$fileContent = "";
	
	$fp = fopen($fileName, "r");
	if($fp){
		$fileContent = fread($fp, filesize($fileName));
	}
	fclose($fp);
	return $fileContent;
}

function trimBodyText($theText, $lmt=70, $s_chr="\n", $s_cnt=1){
	  $pos = 0;
	  $trimmed = FALSE;
	  for($i=0; $i <= $s_cnt; $i++){
		  if($tmp = strpos($theText, $s_chr, $pos)){
			  $pos = $tmp;
			  $trimmed = TRUE;
		  }else{
			  $pos = strlen($theText);
			  $trimmed = FALSE;
			  break;
		  }
	  }
	  $theText = substr($theText, 0, $pos);
	  if(strlen($theText) > $lmt){
		  $theText = substr($theText, 0, $lmt);
		  $theText = substr($theText, 0, strrpos($theText, ' '));
		  $trimmed = TRUE;
	  }
	  if($trimmed){
		  $theText .= "...";
	  }
	  return $theText;
  }

function paginate($limit=10, $tot_rows){
	
	$numrows = $tot_rows;
	$pagelinks = "<div class=\"pagelinks\">";
	if($numrows > $limit){
		if(isset($_GET['page'])){
			$page = $_GET['page'];
		}else{
			$page = 1;
		}

		$currpage = $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];
		$currpage = str_replace("&page=".$page,"",$currpage);

		if($page == 1){
			$pagelinks .= "<span class=\"pagelinks\">&lt; PREV </span>";
		}else{
			$pageprev = $page - 1;
			$pagelinks .= "<a class=\"pagelinks\" href=\"" . $currpage . "&page=". $pageprev . "\">&lt; PREV </a>";
		}

		$numofpages = ceil($numrows / $limit);
		$range = 7;
		$lrange = max(1, $page-(($range-1)/2));
		$rrange = min($numofpages, $page+(($range-1)/2));
		if(($rrange - $lrange) < ($range - 1)){
			if($lrange == 1){
				$rrange = min($lrange + ($range-1), $numofpages);
			}else{
				$lrange = max($rrange - ($range-1), 0);
			}
		}
		
		if($lrange > 1){
			$pagelinks .= " .. ";
		}else{
			$pagelinks .= " &nbsp;&nbsp; ";
		}
		for($i = 1; $i <= $numofpages; $i++){
			if($i == $page){
				$pagelinks .= "<font color=#ff0000><b>$i</b></font>";
			}else{
				if($lrange <= $i && $i <= $rrange){
					$pagelinks .= " <a class=\"pagelinks\" href=\"".$currpage."&page=".$i."\">" . $i . "</a>  ";
				}
			}
		}
		
		if($rrange < $numofpages){
			$pagelinks .= " .. ";
		}else{
			$pagelinks .= " &nbsp;&nbsp; ";
		}

		if(($numrows - ($limit * $page)) > 0){
			$pagenext = $page + 1;
			$pagelinks .= "<a class=\"pagelinks\" href=\"". $currpage . "&page=" . $pagenext . "\"> NEXT &gt;</a>";
		}else{
			$pagelinks .= " <span class=\"taxtxt\"> NEXT &gt;</span>";
		}
	}else{
		//$pagelinks .= "<span class=\"pagelinks\">&lt; PREV</span>&nbsp;&nbsp;";
		//$pagelinks .= "<span class=\"pagelinks\">&nbsp;&nbsp;&nbsp;NEXT &gt;</span>&nbsp;&nbsp;";
	}
return $pagelinks;
}

function pagingIndex($limit=10, $tot_rows){
	
	$numrows = $tot_rows;
	$pagelinks = "<div class=\"type1\">";
	if($numrows > $limit){
		if(isset($_GET['page'])){
			$page = $_GET['page'];
		}else{
			$page = 1;
		}

		$currpage = $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];
		$currpage = str_replace("&page=".$page,"",$currpage);

		if($page == 1){
			$pagelinks .= "<img src='images/OFFERS.jpg' border='0' align='absmiddle' >";
		}else{
			$pageprev = $page - 1;
			$pagelinks .= "<a class=\"type1\" href=\"" . $currpage . "&page=". $pageprev . "\"> <img src='images/OFFERS.jpg' border='0' align='absmiddle' > </a>";
		}

		$numofpages = ceil($numrows / $limit);
		$range = 7;
		$lrange = max(1, $page-(($range-1)/2));
		$rrange = min($numofpages, $page+(($range-1)/2));
		if(($rrange - $lrange) < ($range - 1)){
			if($lrange == 1){
				$rrange = min($lrange + ($range-1), $numofpages);
			}else{
				$lrange = max($rrange - ($range-1), 0);
			}
		}
		
		if($lrange > 1){
			$pagelinks .= " .. ";
		}else{
			$pagelinks .= " &nbsp;&nbsp; ";
		}
		for($i = 1; $i <= $numofpages; $i++){
			if($i == $page){
				$pagelinks .= "<font color=#CC3300><b>$i </b></font>|";
			}else{
				if($lrange <= $i && $i <= $rrange){
					$pagelinks .= " <a class=\"type1\" href=\"".$currpage."&page=".$i."\">" . $i . "</a> | ";
				}
			}
		}		
	}else{
		//$pagelinks .= "<span class=\"pagelinks\">&lt; PREV</span>&nbsp;&nbsp;";
		//$pagelinks .= "<span class=\"pagelinks\">&nbsp;&nbsp;&nbsp;NEXT &gt;</span>&nbsp;&nbsp;";
	}
return $pagelinks;
}

function fun_admin_user_type_array(){
	$auType = array(
					"1" => "Super Admin",
					"2" => "Sub Admin"
				);
	return $auType;
}		

function fun_get_user_type_option($uTypeNo=''){
	$userTypeArray = fun_admin_user_type_array();
	foreach($userTypeArray as $keys => $vals){
		if($keys==$uTypeNo){
			$selected = " selected";
		}else{
			$selected = "";
		}
		echo "<option value=\"".$keys."\" ".$selected.">";
		echo $vals;
		echo "</option>\n";
	}
}

function fun_get_user_type_name($uTypeNo=''){
	$userTypeArray = fun_admin_user_type_array();
	$userTypeName = "";
	foreach($userTypeArray as $keys => $vals){
		if($keys==$uTypeNo){
			$userTypeName = $vals;
		}
	}
	return $userTypeName;
}

function fun_cus_title_option($title){
	echo "<option value=\"Mr.\"";
	if($title=="Mr."){
		echo " selected";
	}
	echo ">Mr.</option>\n";
	
	echo "<option value=\"Mrs.\"";
	if($title=="Mrs."){
		echo " selected";
	}
	echo ">Mrs.</option>\n";
	
	echo "<option value=\"Miss.\"";
	if($title=="Miss."){
		echo " selected";
	}
	echo ">Miss.</option>\n";
	
	echo "<option value=\"Dr.\"";
	if($title=="Dr."){
		echo " selected";
	}
	echo ">Dr.</option>\n";
}

function funOrderStatusArray(){
	$osArray = array(
					OS_PENDING => "Pending",
					OS_CONFIRM => "Confirmed",
					OS_SHIPPED => "Shipped",
					OS_COMPLETE => "Completed",
					OS_CANCELLED => "Cancelled",
				);
	return $osArray;
}
function funOrderStatusOption($osNo){
	$osArray = funOrderStatusArray();
	foreach($osArray as $keys => $vals){
		if((int)$keys==(int)$osNo){
			$selected = " selected";
		}else{
			$selected = "";
		}
		echo "<option value=\"".$keys."\" ".$selected.">";
		echo $vals;
		echo "</option>\n";
	}
}
function funOrderStatusName($osNo){
	$osArray = funOrderStatusArray();
	$osName = "";
	foreach($osArray as $keys => $vals){
		if((int)$keys==(int)$osNo){
			$osName = $vals;
		}
	}
	return $osName;
}


function funPaymentStatusArray(){
	$psArray = array(
					PS_PENDING => "Pending",
					PS_CONFIRM => "Confirmed",
					PS_INPROCESS => "In process",
					PS_CLEAR => "Cleared",
					PS_CANCELLED => "Cancelled",
				);
	return $psArray;
}
function funPaymentStatusOption($psNo){
	$psArray = funPaymentStatusArray();
	foreach($psArray as $keys => $vals){
		if((int)$keys==(int)$psNo){
			$selected = " selected";
		}else{
			$selected = "";
		}
		echo "<option value=\"".$keys."\" ".$selected.">";
		echo $vals;
		echo "</option>\n";
	}
}
function funPaymentStatusName($psNo){
	$psArray = funPaymentStatusArray();
	$psName = "";
	foreach($psArray as $keys => $vals){
		if((int)$keys==(int)$psNo){
			$psName = $vals;
		}
	}
	return $psName;
}

function funOrderStatusColorArray(){
	$osColorArray = array(
					OS_PENDING => "#ff0000",
					OS_CONFIRM => "#336600",
					OS_SHIPPED => "#0033CC",
					OS_COMPLETE => "#993399",
					OS_CANCELLED => "000000"
	);
	return $osColorArray;
}
function funOrderStatusColor($osNo){
	$ocArray = funOrderStatusColorArray();
	$colorName = "";
	foreach($ocArray as $keys => $vals){
		if((int)$keys==(int)$osNo){
			$colorName = $vals;
		}
	}
	return $colorName;
}

function funPaymentStatusColorArray(){
	$psColorArray = array(
					PS_PENDING => "#ff0000",
					PS_CONFIRM => "#336600",
					PS_INPROCESS => "#0033CC",
					PS_CLEAR => "#993399",
					PS_CANCELLED => "000000"
	);
	return $psColorArray;
}
function funPaymentStatusColor($psNo){
	$pcArray = funPaymentStatusColorArray();
	$colorName = "";
	foreach($pcArray as $keys => $vals){
		if((int)$keys==(int)$psNo){
			$colorName = $vals;
		}
	}
	return $colorName;
}
?>