<?php
class DB{
	var $dbLink;
	var $dbHost;
	var $dbUsername;
	var $dbPassword;
	var $dbDatabase;
	var $dbConnectPersistant;
	
	function DB(){ // class constructor
		
		$this->dbHost = "localhost";
		$this->dbUsername = "fs-admin";
		$this->dbPassword = "camp=Flam";
		$this->dbDatabase = "db_fleetstreet";
		/*
		$this->dbHost = "localhost";
		$this->dbUsername = "root";
		$this->dbPassword = "";
		$this->dbDatabase = "db_fleet_street";*/
		
		$this->dbConnectPersistant = false;
		$this->fun_db_connect();
	} 
	
	
	
	function fun_db_connect(){
		if($this->dbConnectPersistant){
			$this->dbLink = @mysql_pconnect($this->dbHost, $this->dbUsername,  $this->dbPassword) or die("<font color='#ff0000' face='verdana' face='2'>Error: Could not connect to database server!</font>");
		}else{
			$this->dbLink = @mysql_connect($this->dbHost, $this->dbUsername,  $this->dbPassword) or die("<font color='#ff0000' face='verdana' face='2'>Error: Could not connect to database server!</font>");
		}
		@mysql_select_db($this->dbDatabase, $this->dbLink) or die("<font color='#ff0000' face='verdana' face='2'>Error: Unable to select database!</font>");
	}
	
	function fun_db_query($sql){
		return @mysql_query($sql, $this->dbLink);
	}
	
	function fun_db_get_num_rows($result){
		return @mysql_num_rows($result);
	}
	
	function fun_db_get_affected_rows(){
		return @mysql_affected_rows($this->dbLink);
	}
	
	function fun_db_last_inserted_id(){
		return @mysql_insert_id($this->dbLink);
	}
	
	function fun_db_fetch_rs_array($result){
		return @mysql_fetch_array($result);
	}
	
	function fun_db_fetch_rs_object($result){
		return @mysql_fetch_object($result);
	}
	
	function fun_db_fetch_rs_row($result){
		return @mysql_fetch_row($result);
	}
	
	function fun_db_free_resultset($result){
		@mysql_free_result($result);
	}
	
	function fun_db_close_connection(){
		@mysql_close($this->dbLink);
	}
}
?>