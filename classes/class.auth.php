<?php
class auth extends ecert{
    var $msg = '';
    
    
function __construct(&$parentobj){//critical to avoid re-instantiation of the parent class
	$this->parent = $parentobj; //assign and make all parent class variables (properties) and methods accessible via $this->parent
}
//Function to get all Candidates
function getCandidates(){
        $sql = "SELECT * FROM candidates_details";
    if($allcandidates = $this->parent->queryArray($sql,$this->parent->dbconn)){  
        return $allcandidates;
    }
}
//End of Function
//Function to get all Question
function getQuestions(){
    $sql = "SELECT * FROM test_question";
if($allquestions = $this->parent->queryArray($sql,$this->parent->dbconn)){  
    return $allquestions;
}
}
//End of Function
//Function to get all Certification Examinations
function getExaminations(){
    $sql = "SELECT * FROM certification_tests";
if($allTests = $this->parent->queryArray($sql,$this->parent->dbconn)){  
    return $allTests;
}
}
//Function to get all Transactions
function getTransactions(){
    $sql = "SELECT * FROM transactions";
if($alltransactions = $this->parent->queryArray($sql,$this->parent->dbconn)){  
    return $alltransactions;
}
}
//End of Function
//Function to register student
    function registerCandidate($fn,$ln,$on='',$pn,$em,$gen,$reg_date='',$amt,$type,$desc,$log=''){
        $reg_date = $this->parent->now(); 
        $sql = "INSERT INTO candidates_details(last_name,first_name,other_name,phone_number,gender,reg_date,email) VALUES('".$ln."','".$fn."','".$on."','".$pn."','".$gen."','".$reg_date."','".$em."')";
            $this->parent->queryDML("BEGIN",$this->parent->dbconn);
        $pwds = substr(str_shuffle($pn.$fn),strlen($fn));
        $pwd = substr($pwds,1,4);
        if($candidateid = $this->parent->queryLastInsert($sql,$this->parent->dbconn)){     echo $sql;
            $hashed_id= md5($candidateid);
            $pwds = $pn.$fn;
            shuffle($pwds);
            $pwd = substr($pwds,5);
            $hash_pwd = password_hash($pwd,PASSWORD_BCRYPT);
            $sql2 = "INSERT INTO auth_candidate(candidate_authId,candidate_pwd) VALUES('".$hashed_id."','".$hash_pwd."')";
            if($res = $this->parent->queryDML($sql2,$this->parent->dbconn)){
                $this->parent->queryDML("COMMIT",$this->parent->dbconn);
                $this->parent->updateTransactions($candidateid,$amt,$type,$desc,$log,$str);
                return $candidateid;
            }else{
                $this->parent->queryDML("ROLLBACK",$this->parent->dbconn);
                $this->msg = 'Error Registering Candidate';}
        }
        mysqli_close($this->parent->dbconn);
    }//End function

    //Function to Login student
    function loginCandidate($email, $password){
        $sql = "SELECT * FROM candidates_details WHERE email ='".$this->parent->escape_string($email)."'";

        if($row = $this->parent->queryRow($sql,$this->parent->dbconn)){
            $candidateid = md5($row['candidate_id']);
            $sql2 = "SELECT * FROM auth_candidate WHERE candidate_authId ='".$candidateid."'";
            if($pwd_row = $this->parent->queryRow($sql2,$this->parent->dbconn)){
                if(password_verify($password,$pwd_row['candidate_pwd'])){
                return $row;
                }else{
                    $this->msg = 'Invalid Password';
                }
            }   	
        } else {
            $this->msg = "Sorry, this account does not exist on our platform";
        }
        return $this->msg;
        mysqli_close($this->parent->dbconn);
    }//end function	

    function updateCandidateDetails($candidateId,$str,$certificationId=0,$candidateTestId=0,$testQuestionId=0,$response=0,$score=0){
        $res_dateTime =  $this->parent->now(3); 
        switch($str){
            case "answer":{
                $sql = "UPDATE candidate_test_response SET candidate_testQuestionResponse ='".$response."',candidate_testQuestionResponse_date='".$res_dateTime."' WHERE candidate_testId='".$candidateTestId."' AND candidate_testQuestionid='".$testQuestionId."'";
                break;
            }
            case "bookmark":{
                $sql = "UPDATE candidate_test_response SET candidate_testQuestionBookmark = 'yes' WHERE candidate_testId='".$candidateTestId."' AND candidate_testQuestionid='".$testQuestionId."'";
                break;
            }
            case "detail":{
            return 'details';
            break;
            }
            case "start":{
                $sql = "UPDATE candidate_tests SET candidate_certificateTestStartDateTime='".$res_dateTime."' WHERE candidate_testId='".$candidateTestId."' AND candidate_id ='".$candidateId."' AND candidate_certificateTestid='".$certificationId."'";
                break;
            }
            case "end":{
                $sql = "UPDATE candidate_tests SET candidate_certificateTestEndDateTime ='".$res_dateTime."',candidate_certificateTestScore ='".$score."',candidate_certificateTestStatus = 'expired' WHERE candidate_testId='".$candidateTestId."' AND candidate_id ='".$candidateId."' AND candidate_certificateTestid='".$certificationId."'";
                break;
            }
            default:{
                $this->msg = 'Incomplete Data sent'; 
            }   
        }
        if($this->parent->queryDML($sql,$this->parent->dbconn)){
            $this->msg = 'Success';
        }else{
            var_dump($this->parent->dbconn);
            $this->msg = 'Error';
        }
        return $this->msg;
        mysqli_close($this->parent->dbconn);
    }//End function

    //Function to Setup questions for Certification exam
    function setCandidateExam($candidateId,$certificationId){
        $reg_date = $this->parent->now();
        $expiry_date =  $this->parent->deviateDate($reg_date,14); 
        $sql = "INSERT INTO candidate_tests(candidate_id,candidate_certificateTestid,candidate_certificateTestRegDate,candidate_certificateTestStartDateTime,candidate_certificateTestEndDateTime,candidate_certificateTestExpiryDate,candidate_certificateTestScore,candidate_certificateTestStatus) VALUES('".$candidateId."','".$certificationId."','".$reg_date."','','','".$expiry_date."','','active')";

        $this->parent->queryDML("BEGIN",$this->parent->dbconn);
    
        if($candidateTestid = $this->parent->queryLastInsert($sql,$this->parent->dbconn)){ $question = [];
            $sql2 = "SELECT test_questionId FROM test_question WHERE test_questionCertificationId = '".$certificationId."'";
            if($question = $this->parent->queryArray($sql2,$this->parent->dbconn)){$sql3 = [];  $testQuestionidarray = [];
                $this->parent->queryDML("COMMIT",$this->parent->dbconn);
            
                    shuffle($question);
                    $testQuestionidarray = array_slice($question, 0, 40);
                foreach($testQuestionidarray as $testQuestionid ){
                    array_push($sql3,"INSERT INTO candidate_test_response(candidate_testId,candidate_testQuestionid,candidate_testQuestionResponse,candidate_testQuestionResponse_date,candidate_testQuestionBookmark,candidate_testQuestionStatus) VALUES('".$candidateTestid."','". $testQuestionid['test_questionId']."',0,'','','open')");
                    }
                if($res = $this->parent->queryTransaction($sql3,$this->parent->dbconn)){
                    $this->msg = 'Success'; 
                }else{ //var_dump($this->parent->dbconn);
                    $this->msg = 'Error Signing Candidate Up for Certification Exam. Please try again later'; 
                }
            }else{ //var_dump($this->parent->dbconn);
                $this->parent->queryDML("ROLLBACK",$this->parent->dbconn);
                $this->msg = 'Error Signing Candidate Up for Certification Exam. Please try again'; 
            } 
        }
    return $this->msg;
    mysqli_close($this->parent->dbconn);
    }//End function

    //Function to get candidate's exam questions
    function getCandidateExam($candidateId,$certificationId)    {
        $sql = "SELECT DISTINCT candidate_testId FROM candidate_tests WHERE candidate_id = '".$candidateId."' AND candidate_certificateTestid = '".$certificationId."'";

        $this->parent->queryDML("BEGIN",$this->parent->dbconn);

        if($testId = $this->parent->queryDML($sql,$this->parent->dbconn)){
            $sql2 = "SELECT candidate_testQuestionid FROM candidate_test_response WHERE candidate_testId = '".$testId."'";
            if($questionIds = $this->parent->queryArray($sql2,$this->parent->dbconn)){
                $this->parent->queryDML("COMMIT",$this->parent->dbconn);
                $res = [];
                foreach($questionIds as $questionId){
                    $sql3 = "SELECT * FROM test_question WHERE test_questionId = '".$questionId["candidate_testQuestionid"]."'";
                    if($resp = $this->parent->queryArray($sql3,$this->parent->dbconn)){
                        array_push($res,$resp);
                        $this->parent->queryDML("COMMIT",$this->parent->dbconn);
                    }else{ //var_dump($this->parent->dbconn);
                        $this->parent->queryDML("ROLLBACK",$this->parent->dbconn);
                        $this->msg = 'Error: Setting Up Candidate\'s Certification Exam. Please try again later'; 
                    }
                }
                return $res;
            }else{ //var_dump($this->parent->dbconn);
                $this->parent->queryDML("ROLLBACK",$this->parent->dbconn);
                $this->msg = 'Error: Setting Up Candidate\'s Certification Exam. Please try again'; 
            } 
        }
        mysqli_close($this->parent->dbconn);
    }//End function

    //Function to set Transactions
    function updateTransactions($candidateId,$amount,$type,$desc='',$log='',$str){
        switch ($type) {
            case 'bank'||'cash'||'online':
                $sql = "INSERT INTO transactions (candidate_id,transactionAmount,transactionDesc,transactionType,transactionLog) VALUES('".$candidateId."','".$amount."','".$desc."','".$type."','".$log."')";
                break;
            case 'uncharged':
                $sql = "UPDATE transactions SET transactionAmount ='".$amount."',transactionDesc ='".$desc."',transactionType = '".$type."', transactionLog = '".$log."' WHERE candidate_id='".$candidateId."'";
                break;
            
            default:
               $this->msg = 'You sent an incomplete data';
                break;
        }            
        
        if($this->parent->queryDML($sql,$this->parent->dbconn)){
            $this->parent->queryDML("COMMIT",$this->parent->dbconn);
            $this->msg = 'Success: Payment Recorded';
        }else{
            $this->parent->queryDML("ROLLBACK",$this->parent->dbconn);
            $this->msg = 'You sent an incomplete data';
        }
    }//End function
}//end class


?>