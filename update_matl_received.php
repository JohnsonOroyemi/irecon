<?php
ob_start();
require('top.inc.php');
$material_id='';
$qty	='';
$source	='';
$file='';
$date	='';
$postedby='';
$msg='';

$file_required='required';
if(isset($_GET['id']) && $_GET['id']!=''){
	$file_required='';
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"SELECT * from material_received where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$material_id=$row['material_id'];
		$qty=$row['quantity'];
		$source=$row['source'];
		$date=$row['date'];
		$postedby =  $_SESSION["user_id"];
	
	}else{
		header('location:material_received.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$material_id=get_safe_value($con,$_POST['material_id']);
	$qty=get_safe_value($con,$_POST['quantity']);
	$source=get_safe_value($con,$_POST['source']);
	$date=get_safe_value($con,$_POST['date']);
	$postedby=get_safe_value($con,$_SESSION['user_id']);

	$res=mysqli_query($con,"SELECT * from material_received where material_id ='$material_id' and quantity ='$qty' and date ='$date'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="inventory already taken";
			}
		}else{
			$msg="inventory already taken";
		}
	}

	


	if($_GET['id']==0){
		if($_FILES['file']['type']!='image/png' && $_FILES['file']['type']!='image/jpg' && $_FILES['file']['type']!='image/jpeg' && $_FILES['file']['type']!='audio/mpeg' && $_FILES['file']['type']!='video/mpeg' && $_FILES['file']['type']!='audio/webm' && $_FILES['file']['type']!='video/webm' && $_FILES['file']['type']!='audio/mp4' && $_FILES['file']['type']!='video/mp4' && $_FILES['file']['type']!='audio/mp3' && $_FILES['file']['type']!='video/Ogg' && $_FILES['file']['type']!='audio/WAV' && $_FILES['file']['type']!='video/WAV' && $_FILES['file']['type']!='application/pdf' && $_FILES['file']['type']!='image/doc'){ 
			$msg="Please select only png,jpg and jpeg image formate";
		}
	}else{
		if($_FILES['file']['type']!=''){
				if($_FILES['file']['type']!='image/png' && $_FILES['file']['type']!='image/jpg' && $_FILES['file']['type']!='image/jpeg' && $_FILES['file']['type']!='audio/mpeg' && $_FILES['file']['type']!='video/mpeg' && $_FILES['file']['type']!='audio/webm' && $_FILES['file']['type']!='video/webm' && $_FILES['file']['type']!='audio/mp4' && $_FILES['file']['type']!='video/mp4' && $_FILES['file']['type']!='audio/mp3' && $_FILES['file']['type']!='video/Ogg' && $_FILES['file']['type']!='audio/WAV' && $_FILES['file']['type']!='video/WAV' && $_FILES['file']['type']!='application/pdf' && $_FILES['file']['type']!='image/doc'){
				$msg="Please select only png,jpg and jpeg image formate";
			}
		}
	}
	
	$targetDir = "uploads/";
    $targetFilePath = $targetDir;

	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			if($_FILES['file']['name']!=''){
				$file=$_FILES['file']['name'];
				move_uploaded_file($_FILES['file']['tmp_name'],   $targetFilePath.$file);
				$update_sql="update material_received set material_id='$material_id' ,quantity='$qty', source='$source', date='$date',  PostedBy='$postedby', file='$file' where id='$id'";
			}else{
				$update_sql="update material_received  set material_id='$material_id' ,quantity='$qty', source='$source', date='$date',  PostedBy='$postedby', file='$file' where id='$id'";
			}
			mysqli_query($con,$update_sql);
		}else{
			$file=$_FILES['file']['name'];
			move_uploaded_file($_FILES['file']['tmp_name'],   $targetFilePath.$file);
			mysqli_query($con,"insert into material_received  (material_id,quantity,source,date,PostedBy,status,file) values('$material_id','$qty', '$source','$date','$postedby',1,'$file')");
		}
		header('location:material_received.php');
		die();
	}
}
?>


<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Material Received</strong><small> Form</small></div>
						<span><?php if(isset($_GET['r'])){echo $_GET['r'];} ?></span>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="materials" class=" form-control-label">Material</label>
									<select class="form-control" name="material_id">
										<option>Select material</option>
										<?php
										$res=mysqli_query($con,"select id,materials from materials order by materials asc");
										while($row=mysqli_fetch_assoc($res)){
											if($row['id']==$material_id){
												echo "<option selected value=".$row['id'].">".$row['materials']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['materials']."</option>";
											}
										}
										?>
									</select>
								</div>

								<div class="form-group">
									<label for="materials" class=" form-control-label">Quantity</label>
									<input type="number" name="quantity" placeholder="Enter Quantity" class="form-control" required value="<?php echo $qty?>">
								</div>

								<div class="form-group">
									<label for="materials" class=" form-control-label">Source</label>
									<input type="text" name="source" placeholder="Enter brand/source of materials" class="form-control" required value="<?php echo $source?>">
								</div>

								<div class="form-group">
									<label for="categories" class=" form-control-label">Invoice</label>
									<input type="file" name="file" class="form-control" <?php echo  $file_required?>>
								</div>

								<div class="form-group">
									<label for="materials" class=" form-control-label">Date</label>
									<input type="date" name="date" placeholder="Enter reporting date" class="form-control" required value="<?php echo $date?>">
								</div>

							   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							   <div class="field_error"><?php echo $msg?></div>
							</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>

<?php
if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	if($type=='status'){
		$operation=get_safe_value($con,$_GET['operation']);
		$id=get_safe_value($con,$_GET['id']);
		if($operation=='active'){
			$status='1';
		}else{
			$status='0';
		}
		$update_status_sql="update materials set status='$status' where id='$id'";
		mysqli_query($con,$update_status_sql);
	}
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from materials where id='$id'";
		mysqli_query($con,$delete_sql);
	}
}
?>

<?php
$sql="select material_received.*,materials.materials from material_received,materials where material_received.material_id=materials.id order by material_received.id desc";
$res=mysqli_query($con,$sql);
?>

<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Materials Received </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>ID</th>
							   <th>Materials</th>
							   <th>Quantity</th>
							   <th>Source</th>
							   <th>Invoice</th>
							   <th>Date</th>
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $row['id']?></td>
							   <td><?php echo $row['materials']?></td>
							   <td><?php echo $row['quantity']?></td>
							   <td><?php echo $row['source']?></td>
							   <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['file']?>"/></td>
							   <td><?php echo $row['date']?></td>
							   <td>
								<?php
								if($row['status']==1){
									echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp;";
								}else{
									echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
								}
								echo "<span class='badge badge-edit'><a href='material_received.php?id=".$row['id']."'>Edit</a></span>&nbsp;";
								
								echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>";
								
								?>
							   </td>
							<?php } ?>
						 </tbody>
					  </table>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
         
<?php
require('footer.inc.php');
?>