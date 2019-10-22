<?
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
require_once("classes/class.ecert.php");
$candidateid = '';
$cert = new ecert();
// if(isset($_POST['fn'])){
 
//   $cert = new ecert();
 
//   $fn = ($_POST['fn']);
//   $ln = ($_POST['ln']);
//   $on = ($_POST['on']);
//   $pn = ($_POST['pn']);
//   $gen = ($_POST['gen']);
//   $amt = ($_POST['amt']);
//   $em = ($_POST['em']);
//   $type = ($_POST['type']);
//   $desc = ($_POST['desc']);

//   $candidateid = $cert->auth->registerCandidate($fn,$ln,$on,$pn,$em,$gen,$amt,$type,$desc,$log);
//   echo  $candidateid;
// }

// $product_arr = array(
//   "id" =>  '$product->id',
//   "name" => '$product->name',
//   "description" => '$product->description',
//   "price" => '$product->price',
//   "category_id" => '$product->category_id',
//   "category_name" => '$product->category_name'
// );
// echo json_encode($product_arr);

// $question =  $cert->auth->getQuestions(); 
// $products_arr =array();
// $products_arr["records"]=array();

// foreach($question as $quest){
// $product_item = array(
//     "id" =>  $quest['test_question'],
//     "name" => $quest['test_questionOption1'],
//     "description" => $quest['test_questionOption2'],
//     "price" => $quest['test_questionOption3'],
//     "category_id" => $quest['test_questionOption4'],
//     "category_name" => $quest['test_questionOption5']  
// ); 
// array_push($products_arr["records"], $product_item);
// } 
// echo json_encode($products_arr);


$question =  $cert->auth->getExaminations(); 
$products_arr =array();

foreach($question as $quest){
$product_item = array(
    "id" =>  $quest['certification_testName'],
    "name" => $quest['certification_testDuration'],
    "description" => $quest['certification_testPassScore'],
    "price" => $quest['certification_testStatus'], 
); 
array_push($products_arr, $product_item);
}
$products_obj["records"] = $products_arr;

echo json_encode($products_obj);



// $candidateid = $cert->auth->registerCandidate($fn='AJ',$ln='sfsf',$on='ffsaf',$pn='09045672138',$em='wfwf',$gen='qfdwfw',$amt='2300',$type='3400',$desc='egfdfedf',$log='ffefef');
// echo  $candidateid;


//$msg = $cert->auth->setCandidateExam(1,1);
//$msg = $cert->auth->getCandidateExam(1,1);
//$msg = $cert->auth->updateCandidateDetails(1,'end',1,7,57,3,15);

//print_r($msg);
//print_r($msg2);
?>

