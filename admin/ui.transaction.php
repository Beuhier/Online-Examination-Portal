<div class="btn-toolbar justify-content-between border-bottom" role="toolbar" aria-label="Toolbar with button groups" style="padding:10px;">
<button id="btn_signup" type="button" class="btn btn-success text-white" onclick="try{ $('#div_register').slideDown(); }catch(e){ console.log(e.message); }"><i class="fas fa-user-plus"></i>&nbsp;New Transaction&nbsp;</button>

<button id="btn_all" type="button" class="btn btn-info text-white ml-1" onclick="try{ $('#div_register').slideDown(); }catch(e){ console.log(e.message); }"><i class="fas fa-list"></i>&nbsp;All Transactions&nbsp;</button>
</div>

<div class="divstack_transaction card-body table-responsive-md" id="div_transaction_table" style="z-index: -10;">
	<table id="table_transaction" class="table display small" style="width:100%">
    </table>
</div>






<script>
$(document).ready(function(){
var invtable = $('#table_transactions').DataTable({
         "order": [[ 0, "desc"]],'retrieve':true,'data':[],'columns':[{title:"",visible:false}, {title:"First Name"},{title:"Last Name"}, {title:"Contact No"}, {title:"Gender"},{title:"Email"},{title:"Registration date"},{title:"Status"}]}); });
</script>