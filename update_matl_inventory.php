<?php
ob_start();
require('top.inc.php');
$material_name='';
$used	='';
$purpose	='';
$material_date	='';
$postedby='';
$msg='';
?>

<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Material Inventory</strong><small> Form</small></div>
  
<div class="table-responsive">
            <table class="table table-bordered" id="crud_table">
               <thead>
                  <tr>
                     <th>Material on site</th>
                     <th>Used</th>
                     <th>Purpose</th>
					 <th>Date</th>
                  </tr>
               </thead>


      <tbody> </tbody>
	  </table>
    <div align="right">
     <button type="button" name="add" id="add" class="btn btn-success btn-xs">+</button>
    </div>
    <div align="center">
     <button type="button" name="save" id="save" class="btn btn-info">Save</button>
    </div>
    <br />
    <div id="inserted_item_data"></div>
   </div>
  </div>
                     </div>
                  </div>
               </div>
            </div>



<script>
$(document).ready(function(){
 var count = 1;
   var id = 0;

 $('#add').click(function(){
  count = count + 1;
  
  var htmls_option = ``;
  var html_code = ``;
 $.ajax({
      type:"GET",
      url: "mat_option-fetch.php",
      data: 'json',
      success: function(res){

      var result = res.slice(1,-1);

      var nameArr = result.split(',');

      nameArr.forEach(
            (re) => {
               htmls_option += `<option>${re.slice(1,-1)}</option>`;
               }
      );
   }
   });
   html_code += `<tr id="row${count}"><td  contenteditable="true" class="material_name"><select class="form-control" name="material_name"><option selected>Select activity</option>
										<?php
										$res=mysqli_query($con,"select id,materials from materials order by id asc");
										while($row=mysqli_fetch_assoc($res)){
												echo "<option  value=".preg_replace('/\s+/', '_', $row['materials']).">".$row['materials']."</option>";
										}
										?></select></td><td contenteditable='true' class='used'><input type='number' name='used' placeholder='used' class='form-control'></td><td  contenteditable="true" class="purpose"><select class="form-control" name="purpose"><option selected>Select activity</option>
										<?php
										$res=mysqli_query($con,"select id,work_activities from work_activities order by id asc");
										while($row=mysqli_fetch_assoc($res)){
												echo "<option  value=".preg_replace('/\s+/', '_', $row['work_activities']).">".$row['work_activities']."</option>";
										}
										?></select></td><td  contenteditable='true' class='material_date'><input type='date' name='material_date' required value='<?php echo $material_date ?>' ></td><td><button type='button' name='remove' data-row='row${count}' class='btn btn-danger btn-xs remove'>-</button></td></tr>`;
   $('#crud_table').append(html_code);
 });
 
 $(document).on('click', '.remove', function(){
  var delete_row = $(this).data("row");
  $('#' + delete_row).remove();
 });
 
 $('#save').click(function(){
  var material_name = [];
  var used = [];
  var purpose = [];
  var material_date = [];

  
  $('.material_name').each(function(){
   material_name.push($(this).find('select').val());
});

  $('.used').each(function(){
   used.push($(this).find('input').val());
  });

  $('.purpose').each(function(){
	purpose.push($(this).find('select').val());
});

  $('.material_date').each(function(){
	material_date.push($(this).find('input').val());

});

  $.ajax({
   url:"mat_insert.php",
   method:"POST",
   data:{material_name:material_name, used:used, purpose:purpose, material_date:material_date},
   success:function(data){
    alert(data);
    for(var i=2; i<= count; i++)
    {
     $('tr#'+i+'').remove();
    }
   }
  });
 });
});
</script>


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
$sql="select * from material_inventory order by id desc";
$res=mysqli_query($con,$sql);
?>

<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Materials Inventory </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>ID</th>
							   <th>Materials</th>
							   <th>Used</th>
							   <th>Purpose</th>
							   <th>Date</th>
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							<?php 
							if(isset($_SESSION["user_id"])) { 
							if($row["PostedBy"] === $_SESSION["user_id"]){?>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $row['id']?></td>
							   <td><?php echo $row['material_name']?></td>
							   <td><?php echo $row['used']?></td>
							   <td><?php echo $row['purpose']?></td>
							   <td><?php echo $row['material_date']?></td>
							   <td>
								<?php
								if($row['status']==1){
									echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp;";
								}else{
									echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
								}
								echo "<span class='badge badge-edit'><a href='manage_resource.php?id=".$row['id']."'>Edit</a></span>&nbsp;";
								
								echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>";
								
								?>
							   </td>
							   <?php }
								}else{
								header("location:signin.php");
							}
								?>
							</tr>
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