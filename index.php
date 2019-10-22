
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
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
  <!-- <script src="js/custom.js"></script> -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="css/style.css"> -->
</head>
<body>
<!-- login section -->
	<div class="row">
		<div class="offset-sm-3 col-md-6 col-sm-12">
			<div class="card"> 
				<div class="card-header bg-info"><i class="fa fa-user-lock"></i>&nbsp;&nbsp;&nbsp;LOGIN HERE&nbsp;&nbsp;&nbsp;&nbsp;<button id="btn_signup" type="button" class="btn btn-info text-dark btn-sm float-right" onclick="try{ $('#div_register').slideDown(); }catch(e){ console.log(e.message); }"><i class="fas fa-user-plus"></i>&nbsp;&nbsp;&nbsp;Register&nbsp;&nbsp;</button></div>
				
					<div class="card">
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

  </body>
</html>
