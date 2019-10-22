<div class="btn-toolbar justify-content-between border-bottom" role="toolbar" aria-label="Toolbar with button groups" style="padding:10px;">
	<button id="btn_signup" type="button" class="btn btn-success text-white"><i class="fas fa-user-plus"></i>&nbsp;&nbsp;&nbsp;New Candidate&nbsp;&nbsp;</button>

	<button id="btn_all" type="button" class="btn btn-info text-white ml-1"><i class="fas fa-list"></i>&nbsp;&nbsp;&nbsp;All Candidate&nbsp;&nbsp;</button>
</div>

<div class="divstack_candidates card-body table-responsive-md" id="div_candidates_table" style="z-index: -10;">
	<table id="table_candidates" class="table display small" style="width:100%">
    </table>
</div>


<div class="divstack_candidates card" id="div_register" style="display:none">
<form>
	<div class="card-header">Register&nbsp;&nbsp;<span class="float-right" onclick="try{ $('#div_register').slideUp(); }catch(e){ console.log(e.message); }"><i class="fas fa-window-close"></i></span></div>
	<div class="card-body">
		<div class="row">
			<div class="col-sm-12 col-md-4">
				<div class="form-group">
					<label for="tbo_firstname">First Name&nbsp;*</label>&nbsp;&nbsp;&nbsp;<span id="span_firstname" style="display:none"><i class="fas fa-check-circle text-success"></i></span>
					<input type="text" class="form-control" id="tbo_firstname" placeholder="First Name">
				</div>
			</div>
			<div class="col-sm-12 col-md-4">
				<div class="form-group">
					<label for="tbo_lastname">Last Name&nbsp;*</label>&nbsp;&nbsp;&nbsp;<span id="span_lastname" style="display:none"><i class="fas fa-check-circle text-success"></i></span>
					<input type="text" class="form-control" id="tbo_lastname" placeholder="Last Name">
				</div>
			</div>
			<div class="col-sm-12 col-md-4">
				<div class="form-group">
					<label for="tbo_lastname">Middle Name</label>&nbsp;&nbsp;&nbsp;<span id="span_mid" style="display:none"><i class="fas fa-check-circle text-success"></i></span>
					<input type="text" class="form-control" id="tbo_midname" placeholder="Middle Name">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-4">
				<div class="form-group">
					<label for="tbo_phone">Phone Number&nbsp;*</label>&nbsp;&nbsp;&nbsp;<span id="span_phone" style="display:none"><i class="fas fa-check-circle text-success"></i></span>
					<input type="number" class="form-control" id="tbo_phone" placeholder="Phone Number">
				</div>
			</div>
			<div class="col-sm-12 col-md-4">
				<div class="form-group">
					<label for="tbo_gender">Gender&nbsp;*</label>&nbsp;&nbsp;&nbsp;<span id="span_gender" style="display:none"><i class="fas fa-check-circle text-success"></i></span>
					<select class=" form-control" id="tbo_gender" placeholder="Select Gender" >
						<option value="">Select Gender</option>
						<option value="male">Male</option>
						<option value="female">Female</option>
					</select>
				</div>
			</div>
			<div class="col-sm-12 col-md-4">
				<div class="form-group">
					<label for="tbo_email">Email address&nbsp;*</label>&nbsp;&nbsp;&nbsp;<span id="span_email" style="display:none"><i class="fas fa-check-circle text-success"></i></span>
					<input type="email" class="form-control" id="tbo_email" aria-describedby="emailHelp" placeholder="Enter email">
				</div>
			</div>
		</div>
		<h6>Payment Details</h6>
		<div class="row">
			<div class="col-sm-12 col-md-4">
				<div class="form-group">
					<label for="tbo_amt">Amount&nbsp;*</label>&nbsp;&nbsp;&nbsp;<span id="span_amt" style="display:none"><i class="fas fa-check-circle text-success"></i></span>
					<div class='input-group'><div class='input-group-prepend'><span class='input-group-text'>₦</span></div><input type='number' id="tbo_amt" placeholder='Amount Paid' class='form-control'></div>
				</div>
			</div>
			<div class="col-sm-12 col-md-4">
				<div class="form-group">
					<label for="tbo_gender">Payment Method&nbsp;*</label>&nbsp;&nbsp;&nbsp;<span id="span_type" style="display:none"><i class="fas fa-check-circle text-success"></i></span>
					<select class=" form-control" id="tbo_type">
						<option value="">Select Payment Method</option>
						<option value="uncharged">Uncharged</option>
						<option value="bank">Bank</option>
						<option value="cash">Cash</option>
						<option value="online">Online</option>
					</select>
				</div>
			</div>
			<div class="col-sm-12 col-md-4">
				<div class="form-group">
					<label for="tbo_desc">Description&nbsp;*</label>&nbsp;&nbsp;&nbsp;<span id="span_desc" style="display:none"><i class="fas fa-check-circle text-success"></i></span>
					<input type="text" class="form-control" id="tbo_desc" aria-describedby="emailHelp" placeholder="Payment Description">
				</div>
			</div>
		</div>
	</div>
	<div class="card-footer">
			<div class="alert alert-warning" id="alert_register" style="display:none;"></div>
			<button id="btn_register" type="button" class="btn btn-info btn-block text-dark" ><i class="fas fa-user-plus"></i>&nbsp;&nbsp;&nbsp;REGISTER&nbsp;&nbsp;</button>
	</div>
	</div>
	</form>
</div>
<script>

onclick=""
$(document).on('click','#btn_all',function(){try{
	$('.divstack_candidates:not(#div_candidates_table)').slideUp(); 
	$('#div_candidates_table').slideDown();
		<? ?>
	
	
	}catch(e){ console.log(e.message);}
});

$(document).on('click','#btn_signup',function(){try{
	$('.divstack_candidates:not(#div_register)').slideUp(); 
	$('#div_register').slideDown();}catch(e){ console.log(e.message);}
});

	$(document).ready(function(){
		var invtable = $('#table_candidates').DataTable({
         "order": [[ 0, "desc"]],'retrieve':true,'data':[],'columns':[{title:"",visible:false}, {title:"First Name"},{title:"Last Name"}, {title:"Contact No"}, {title:"Gender"},{title:"Email"},{title:"Registration date"},{title:"Status"}]}); });

		$(document).on('click','#btn_register',function(){
			$(this).removeClass('btn-info').addClass('btn-warning').html('<i class=\'fas fa-spin fa-spinner\'></i>&nbsp;&nbsp;&nbsp;<span class=\'small\'>Registering......</span>&nbsp;');
			
			var empty = 0;
				var fn = $('#tbo_firstname').val();
				var ln = $('#tbo_lastname').val();
				var on = $('#tbo_midname').val();
				var pn = $('#tbo_phone').val();
				var em = $('#tbo_email').val();
				var amt = $('#tbo_amt').val();
				var gen = $('#tbo_gender').val();
				var type = $('#tbo_type').val();
				var desc = $('#tbo_desc').val();
		

		if(fn == '' ){$('#span_firstname').css('display','inline-block').removeClass('text-success').addClass('text-danger').html('<i class=\'fas fa-times-circle\'></i>&nbsp;&nbsp;&nbsp;');
		$('#alert_register').slideDown().html('Fields with * are compulsory');
		setTimeout(function(){ $('#span_firstname').css('display','none').removeClass('text-danger').addClass('text-success').html('<i class=\'fas fa-check-circle\'></i>&nbsp;&nbsp;&nbsp;');$('#alert_register').slideUp().html('');$('#btn_register').removeClass('btn-warning').addClass('btn-info').html('<i class="fas fa-user-plus"></i>&nbsp;&nbsp;&nbsp;REGISTER&nbsp;&nbsp;');},5000);
		
		}
		else{$('#span_firstname').css('display','inline-block');empty += 1;}
			
		if(ln == '' ){$('#span_lastname').css('display','inline-block').removeClass('text-success').addClass('text-danger').html('<i class=\'fas fa-times-circle\'></i>&nbsp;&nbsp;&nbsp;');
		$('#alert_register').slideDown().html('Fields with * are compulsory');
		setTimeout(function(){$('#span_lastname').css('display','none').removeClass('text-danger').addClass('text-success').html('<i class=\'fas fa-check-circle\'></i>&nbsp;&nbsp;&nbsp;'); $('#alert_register').slideUp().html('');$('#btn_register').removeClass('btn-warning').addClass('btn-info').html('<i class="fas fa-user-plus"></i>&nbsp;&nbsp;&nbsp;REGISTER&nbsp;&nbsp;');},5000);
	
		}
		else{
				$('#span_lastname').css('display','inline-block');empty += 1;
			}
		
		if(pn == '' ){$('#span_phone').css('display','inline-block').removeClass('text-success').addClass('text-danger').html('<i class=\'fas fa-times-circle\'></i>&nbsp;&nbsp;&nbsp;');
			$('#alert_register').slideDown().html('Fields with * are compulsory');
			setTimeout(function(){$('#span_phone').css('display','none').removeClass('text-danger').addClass('text-success').html('<i class=\'fas fa-check-circle\'></i>&nbsp;&nbsp;&nbsp;'); $('#alert_register').slideUp().html('');$('#btn_register').removeClass('btn-warning').addClass('btn-info').html('<i class="fas fa-user-plus"></i>&nbsp;&nbsp;&nbsp;REGISTER&nbsp;&nbsp;');},5000);
		
			}else{
				$('#span_phone').css('display','inline-block');empty += 1;
			}
			
		if(em == '' ){$('#span_email').css('display','inline-block').removeClass('text-success').addClass('text-danger').html('<i class=\'fas fa-times-circle\'></i>&nbsp;&nbsp;&nbsp;');
			$('#alert_register').slideDown().html('Fields with * are compulsory');
			setTimeout(function(){$('#span_email').css('display','none').removeClass('text-danger').addClass('text-success').html('<i class=\'fas fa-check-circle\'></i>&nbsp;&nbsp;&nbsp;'); $('#btn_register').removeClass('btn-warning').addClass('btn-info').html('<i class="fas fa-user-plus"></i>&nbsp;&nbsp;&nbsp;REGISTER&nbsp;&nbsp;'); $('#alert_register').slideUp().html('')},5000);
			}else{
				$('#span_email').css('display','inline-block');empty += 1;
			}
			
		if(amt == '' ){$('#span_amt').css('display','inline-block').removeClass('text-success').addClass('text-danger').html('<i class=\'fas fa-times-circle\'></i>&nbsp;&nbsp;&nbsp;');
			$('#alert_register').slideDown().html('Fields with * are compulsory');
			setTimeout(function(){$('#span_amt').css('display','none').removeClass('text-danger').addClass('text-success').html('<i class=\'fas fa-check-circle\'></i>&nbsp;&nbsp;&nbsp;'); $('#alert_register').slideUp().html('');$('#btn_register').removeClass('btn-warning').addClass('btn-info').html('<i class="fas fa-user-plus"></i>&nbsp;&nbsp;&nbsp;REGISTER&nbsp;&nbsp;');},5000);
			}else{
				$('#span_amt').css('display','inline-block');empty += 1;
			}
		
		if(gen == '' ){$('#span_gender').css('display','inline-block').removeClass('text-success').addClass('text-danger').html('<i class=\'fas fa-times-circle\'></i>&nbsp;&nbsp;&nbsp;');
			$('#alert_register').slideDown().html('Fields with * are compulsory');
			setTimeout(function(){$('#span_gender').css('display','none').removeClass('text-danger').addClass('text-success').html('<i class=\'fas fa-check-circle\'></i>&nbsp;&nbsp;&nbsp;');
		$('#alert_register').slideUp().html('');$('#btn_register').removeClass('btn-warning').addClass('btn-info').html('<i class="fas fa-user-plus"></i>&nbsp;&nbsp;&nbsp;REGISTER&nbsp;&nbsp;');},5000);
			}else{
				$('#span_gender').css('display','inline-block');empty += 1;
			}
		
		if(desc == '' ){$('#span_desc').css('display','inline-block').removeClass('text-success').addClass('text-danger').html('<i class=\'fas fa-times-circle\'></i>&nbsp;&nbsp;&nbsp;');
			$('#alert_register').slideDown().html('Fields with * are compulsory');
			setTimeout(function(){$('#span_desc').css('display','none').removeClass('text-danger').addClass('text-success').html('<i class=\'fas fa-check-circle\'></i>&nbsp;&nbsp;&nbsp;'); $('#alert_register').slideUp().html('');$('#btn_register').removeClass('btn-warning').addClass('btn-info').html('<i class="fas fa-user-plus"></i>&nbsp;&nbsp;&nbsp;REGISTER&nbsp;&nbsp;');},5000);
			}else{
				$('#span_desc').css('display','inline-block');empty += 1;
			}
			
		if(type == '' ){$('#span_type').css('display','inline-block').removeClass('text-success').addClass('text-danger').html('<i class=\'fas fa-times-circle\'></i>&nbsp;&nbsp;&nbsp;');
			$('#alert_register').slideDown().html('Fields with * are compulsory');
			setTimeout(function(){$('#span_type').css('display','none').removeClass('text-danger').addClass('text-success').html('<i class=\'fas fa-check-circle\'></i>&nbsp;&nbsp;&nbsp;'); $('#alert_register').slideUp().html('');$('#btn_register').removeClass('btn-warning').addClass('btn-info').html('<i class="fas fa-user-plus"></i>&nbsp;&nbsp;&nbsp;REGISTER&nbsp;&nbsp;');},5000);
			}else{
				$('#span_type').css('display','inline-block');empty += 1;
			}
			
		if(empty == 6){
					$.ajax({
				url: "core.php",
				type: "POST",
				data:{fn:fn,ln:ln,on:on,pn:pn,em:em,gen:gen,amt:amt,desc:desc,type:type},
				success:function(response)
				{
					alert(response);
					$('#btn_register').removeClass('btn-warning').addClass('btn-info').html('<i class="fas fa-user-plus"></i>&nbsp;&nbsp;&nbsp;REGISTER&nbsp;&nbsp;');
				$('#alert_register').slideDown().html('Congratulation!!! Your registration a success. Login and sign up for your e-certification examination');
				setTimeout(function(){
						$('#alert_register').slideUp(2000)
				},3000); }
   		});	}
		});
	</script>