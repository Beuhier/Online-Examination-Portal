<?// require_once("../index.php");
$is_authenticated = true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Activ360|Hotel Management Academy</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="hospitality institution,hotel front desk, hotel sales,hotel management">
  <meta name="keywords" content="front office,front desk,point of sale, hotels,schools">
  <meta name="author" content="Activ360">
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
  <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
 
  <!-- <script src="js/custom.js"></script> -->

  <!-- <link rel="stylesheet" href="css/style.css"> -->
</head>
<body>
<? if($is_authenticated){ ?>
<div>
  <div class="jumbotron" style="padding-bottom: 0px; margin-bottom: 0px; position:fixed; width:100%; top:0;z-index: 1000;"> 
      <div style="margin:-25px 5px 5px 10px;">&nbsp;<span class="float-right"><span id="span_logout" style="margin-right:6px;"></span><span style="cursor:pointer;" onclick="try{ Helpdesk.logout(); }catch(e){}">&nbsp;<i class="fa fa-power-off"></i>&nbsp;&nbsp;LOGOUT&nbsp;</span></span></div>
        <ul class="nav nav-pills" id="pills_main" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="tablink_examinations" data-toggle="pill" href="#tabcontent_examinations"><i class="fa fa-pencil-alt" aria-controls="pills-examinations" aria-selected="false"></i>&nbsp;&nbsp;Examinations</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="tablink_candidates" data-toggle="pill" href="#tabcontent_candidates"><i class="fa fa-user-graduate" aria-controls="pills-candidates" aria-selected="false"></i>&nbsp;&nbsp;Candidates</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="tablink_transactions" data-toggle="pill" href="#tabcontent_transactions"><i class="fa fa-money-bill-alt" aria-controls="pills-transactions" aria-selected="false"></i>&nbsp;&nbsp;Transactions</a>
          </li>
        </ul> 
  </div> 
  <div class="tab-content" id="pills-tabContent" style="padding:8px; padding-top: 120px;">
      <div class="tab-pane active fade" id="tabcontent_examinations" role="tabpanel" aria-labelledby="tablink_examinations"><? require_once("ui.examination.php"); ?></div>
      <div class="tab-pane fade" id="tabcontent_transactions" role="tabpanel" aria-labelledby="tablink_transactions"><? require_once("ui.transaction.php"); ?></div>
      <div class="tab-pane fade" id="tabcontent_candidates" role="tabpanel" aria-labelledby="tablink_candidates"><? require_once("ui.candidate.php"); ?></div>
  </div>
</div>  
<? }else{ ?>
<!-- login section -->
<div>
<div class="jumbotron"> 
  <div class="container">
	<div class="row mt-5">
		<div class="offset-sm-3 col-md-6 col-sm-12">
			<div class="card"> 
				<div class="card-header bg-info"><i class="fa fa-user-lock"></i>&nbsp;&nbsp;&nbsp;LOGIN HERE</div>
					<div class="card-body">
            <form>
              <div class="form-group">
                <label for="tbo_username">Username</label>
                <input type="email" class="form-control" id="tbo_username" aria-describedby="username" placeholder="Username">
              </div>
              <div class="form-group">
                <label for="tbo_password">Password</label>
                <input type="password" class="form-control" id="tbo_password" placeholder="Password">
              </div>
              <div class="alert alert-warning" id="alert_login" style="display: none;"></div>
            <button id="btn_login" type="button" class="btn btn-info btn-block text-dark" onclick="try{ Helpdesk.login(); }catch(e){ console.log(e.message); }"><i class="fas fa-sign-in-alt"></i>&nbsp;&nbsp;&nbsp;LOGIN&nbsp;&nbsp;</button>
            </form>
					</div>
				</div>
			</div>
		</div>
	 </div>
  </div>
</div>
</div>
  <? }?>

  <script>

  </script>
  </body>
</html>


