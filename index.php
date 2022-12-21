<?php
require('top.inc.php');
include("connection.php");
if(!isset($_SESSION["user_id"])){
	echo "<script type='text/javascript'>alert('Please sign in to access your dashboard. Thanks.'); window.location.href = 'signup.php';</script>";
  }else{
	  }
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Dashboard </h4>
				</div>
			</div>
		  </div>
	   </div>
	</div>
</div>
<?php
require('footer.inc.php');
?>