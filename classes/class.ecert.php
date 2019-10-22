<?php require_once("class.auth.php");
class ecert{
	var $dbconn = null;
	var $msg = "";

	function __construct(){
		//$this->subObjectInit();
		require_once("vars.inc.php");
		//1.) connect to database
		$link = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
		if (!$link) {
			$this->msg = 'Error: Unable to connect to the database.';
		} else { 
			$this->dbconn = $link;
			//$this->msg = 'Success: Connected to the database.';
			//2.) initialize sub-objects
			$this->subObjectInit();
		}
	}//end function

	function subObjectInit(){
		$this->auth = new auth($this);
	}//end function

	//Function to escape characters
  function escape_string($string){
		// todo: make sure your connection is active etc.
    return $this->dbconn->real_escape_string($string);
	}
	
	function sanitize ($string) {
    $data = $this->dbconn->real_escape_string($string);
    return $data;   
  }

	function queryTransaction($sqls,$conn=null){
		if(is_null($conn)){ $conn = $this->dbconn; }
		$allsuccess = true; //determines if to finally commit or not
		$this->queryDML("BEGIN",$conn);
		$index = 0; 
		foreach($sqls as $sql){
			if(is_array($sql)){
				if(!isset($sql['MODE'])){ $sql['MODE'] = "DML"; }
			} elseif(is_string($sql)) {
				$r['MODE'] = "DML"; 
				$r['SQL'] = $sql;
				unset($sql);
				$sql = $r;
			} 
			if(!isset($sql['STRICT'])){ $sql['STRICT'] = 1; } //STRICT: 0 = Allow fails; 1 = No Fail. If Fail, then abort/rollback transaction
			//end query validation
			//begin execution
			if((is_array($sql)) && (isset($sql['MODE'])) && (isset($sql['SQL']))){
				switch($sql['MODE']){
					case "LIN":
						if($res = $this->queryLinearArray($sql['SQL'],$conn)){ $results[$index] = $res; } else { if($sql['STRICT'] > 0){ $allsuccess = false; $errors[] = $index; } $results[$index] = 0; }	
						break;
					case "ARR":
						if($res = $this->queryArray($sql['SQL'],$conn)){ $results[$index] = $res; } else { if($sql['STRICT'] > 0){ $allsuccess = false; $errors[] = $index; } $results[$index] = 0; }	
						break;
					case "ROW":
						if($res = $this->queryRow($sql['SQL'],$conn)){ $results[$index] = $res; } else { if($sql['STRICT'] > 0){ $allsuccess = false; $errors[] = $index; } $results[$index] = 0; }	
						break;
					case "INSERT":
						if($res = $this->queryLastInsert($sql['SQL'],$conn)){ $results[$index] = $res; } else { if($sql['STRICT'] > 0){ $allsuccess = false; $errors[] = $index; } $results[$index] = 0; }	
						break;
					default://DML
						if($res = $this->queryDML($sql['SQL'],$conn)){ $results[$index] = $res; } else { if($sql['STRICT'] > 0){ $allsuccess = false; $errors[] = $index; } $results[$index] = 0; }	
				}//end switch*/
			}//end if arry (execution
			$index++;
		}//end foreach iteration
		
		if($allsuccess != true){ 
			$this->error = array('code'=>'','msg'=>'There were errors in your transaction query','queries'=>$errors);
			//echo "<li>DB Transaction Q".implode(",Q",$errors)." Error Encountered. ".mysql_error()."</li>";//<li/>".$sqls[0]["SQL"];
			//foreach($errors as $r){ echo "<li>".$sqls[$r]['SQL']."</li>";  } die("--");
			$this->queryDML("ROLLBACK",$conn);
		} else { 
			$this->queryDML("COMMIT",$conn);
			if(isset($results)){
				return $results;
			}
		}
	}//end function

	function queryArray($sql,$conn=null,$keyindex=null){ //keyindex replaces numeric indexes with values in the sent column
		if(is_null($conn)){$conn = $this->dbconn;} 
		if($res = mysqli_query($conn,$sql)){// or die(mysqli_error());
			if(mysqli_num_rows($res) > 0){
				while($xAssoc = mysqli_fetch_assoc($res)){
					if((!is_null($keyindex)) && (isset($xAssoc[$keyindex]))){
						$result_array[$xAssoc[$keyindex]] = $xAssoc;
					} else {
						$result_array[] = $xAssoc;
					}
				}//end while loop
				mysqli_free_result($res);
				return $result_array;	
			}
		} 
	}//endfunction
	
	function queryRow($sql,$conn=null){
		if(is_null($conn)){ $conn = $this->dbconn; }
		if($res = mysqli_query($conn,$sql)){// or die(mysql_error());
			if(mysqli_num_rows($res) > 0){
				while($xAssoc = mysqli_fetch_assoc($res)){
					mysqli_free_result($res);
					return $xAssoc;
				}			
			}
		}
	}//endfunction
	
	function queryDML($sql,$conn=null){ 
		if(is_null($conn)){ $conn = $this->dbconn; }
		if($res = mysqli_query($conn,rawurldecode($sql))){
			if(mysqli_affected_rows($conn) > 0){
				$affectedrows = mysqli_affected_rows($conn);
				return $affectedrows;
			}
		}
	}//end function
	
	function queryLastInsert($sql,$conn=null){ //$rs =0 avoids authentication
		if(is_null($conn)){ $conn = $this->dbconn; }
		if($res = mysqli_query($conn,rawurldecode($sql))){
			$lastinsertid = mysqli_insert_id($conn);
			return $lastinsertid;
		}
	}//end function

	function deviateDate($mydate,$day_dev,$month_dev=0,$year_dev=0,$h_dev=0,$i_dev=0,$s_dev=0){//date in format: Y-m-d, $deviation in no of days
		$date_arr = explode("-",substr($mydate,0,10));
		$h = 0; $i = 0; $s = 0; 
		if(strlen($mydate) > 11){ 
			$time_arr = explode(":",substr($mydate,11));
			if(isset($time_arr[0])){ $h = $time_arr[0]; }
			if(isset($time_arr[1])){ $i = $time_arr[1]; }
			if(isset($time_arr[2])){ $s = $time_arr[2]; } 
			return date("Y-m-d H:i:s",mktime($h+$h_dev,$i+$i_dev,$s+$s_dev,$date_arr[1]+$month_dev,$date_arr[2]+$day_dev,$date_arr[0]+$year_dev));
		} else {
			return date("Y-m-d",mktime(0,0,0,$date_arr[1]+$month_dev,$date_arr[2]+$day_dev,$date_arr[0]+$year_dev));
		}
	}//end function
	
	function reformatDate($date,$format="dM",$oldformat="YYYY-MM-DD"){//"l, F j, Y. [ H:i ] "
		$h=0;$i=0;$s=0;
		if(($date != '') and ($date != '0000-00-00')){
			$date_array = explode("-",substr($date,0,10));
			if(strlen($date) >=16){
				$date_array_2 = explode(":",substr($date,11));
				$date_array = array_merge($date_array,$date_array_2);
			}
			switch(strtoupper($oldformat)){
				case "DD-MM-YYYY":
					$year = $date_array[2]; $month = $date_array[1]; $day = $date_array[0];
					break;
				default:
					$year = $date_array[0]; $month = $date_array[1]; $day = $date_array[2];
			}
			if(isset($date_array[3])){ $h=$date_array[3]; }
			if(isset($date_array[4])){ $i=$date_array[4]; }
			if(isset($date_array[5])){ $s=$date_array[5]; }
			return @date($format,mktime($h,$i,$s,$month,$day,$year));
		} else {
			return "&nbsp;";
		}
	}//end function

	function now($style=0,$hr_diff=0,$min_diff=0,$sec_diff=0){//retrieves the correct time  $days indicates how many days deviation
		$serverstamp = date("Y-m-d-H-i-s");
		$s_a = explode("-",$serverstamp);
		
		switch($style){
			case "1":
				$now = date("l, F j, Y. [ H:i ] ",mktime($s_a[3]+$hr_diff,$s_a[4]+$min_diff,$s_a[5]+$sec_diff,$s_a[1],$s_a[2],$s_a[0]));
				break;
			case "2":
				$now = date("Y-m-d-H-i-s",mktime($s_a[3]+$hr_diff,$s_a[4]+$min_diff,$s_a[5]+$sec_diff,$s_a[1],$s_a[2],$s_a[0]));
				break;
			case "3":
				$now = date("Y-m-d H:i:s",mktime($s_a[3]+$hr_diff,$s_a[4]+$min_diff,$s_a[5]+$sec_diff,$s_a[1],$s_a[2],$s_a[0]));
				break;
			case "4":
				$now = date("HisYmd",mktime($s_a[3]+$hr_diff,$s_a[4]+$min_diff,$s_a[5]+$sec_diff,$s_a[1],$s_a[2],$s_a[0]));
				break;
			case "5":
				$now = date("d-M-Y",mktime($s_a[3]+$hr_diff,$s_a[4]+$min_diff,$s_a[5]+$sec_diff,$s_a[1],$s_a[2],$s_a[0]));
				break;
			case "6":
				$now = date("g:i:s  a",mktime($s_a[3]+$hr_diff,$s_a[4]+$min_diff,$s_a[5]+$sec_diff,$s_a[1],$s_a[2],$s_a[0]));
				break;
			case "7":
				$now = date("D, F j",mktime($s_a[3]+$hr_diff,$s_a[4]+$min_diff,$s_a[5]+$sec_diff,$s_a[1],$s_a[2],$s_a[0]));
				break;
			case "8":
				$now = date("H:i:s",mktime($s_a[3]+$hr_diff,$s_a[4]+$min_diff,$s_a[5]+$sec_diff,$s_a[1],$s_a[2],$s_a[0]));
				break;
			case "9":
				$now = date("w",mktime($s_a[3]+$hr_diff,$s_a[4]+$min_diff,$s_a[5]+$sec_diff,$s_a[1],$s_a[2],$s_a[0]));
				break;
			case "10":
				$now = date("j",mktime($s_a[3]+$hr_diff,$s_a[4]+$min_diff,$s_a[5]+$sec_diff,$s_a[1],$s_a[2],$s_a[0]));
				break;
			case "11":
				$now = date("H",mktime($s_a[3]+$hr_diff,$s_a[4]+$min_diff,$s_a[5]+$sec_diff,$s_a[1],$s_a[2],$s_a[0]));
				break;
			case "12":
				$now = date("l, F j, Y. [ g:i a] ",mktime($s_a[3]+$hr_diff,$s_a[4]+$min_diff,$s_a[5]+$sec_diff,$s_a[1],$s_a[2],$s_a[0]));
				break;
			default:
				$now = date("Y-m-d",mktime($s_a[3]+$hr_diff,$s_a[4]+$min_diff,$s_a[5]+$sec_diff,$s_a[1],$s_a[2],$s_a[0]));
		}
		return $now;
	}//end function
}//end class
?>