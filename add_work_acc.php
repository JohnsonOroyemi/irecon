<?php
ob_start();
require('top.inc.php');
$work_activities_id='';
$file='';
$previous	='';
$actual	='';
$challenges	='';
$date	='';
$postedby='';
$file_required='';
$msg='';
?>

<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Work Accomplished</strong><small> Form</small></div>
  
<div class="table-responsive">
            <table class="table table-bordered" id="crud_table">
               <thead>
                  <tr>
                     <th>Activities</th>
                     <th>Previous % Completion</th>
                     <th>Actual % Completion</th>
                     <th>Challenges</th>
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
      url: "option-fetch.php",
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
   html_code += `<tr id="row${count}"><td  contenteditable="true" class="item_name"><select class="form-control" name="item_name"><option selected>Select activity</option>
										<?php
										$res=mysqli_query($con,"select id,work_activities from work_activities order by id asc");
										while($row=mysqli_fetch_assoc($res)){
												echo "<option  value=".$row['work_activities'].">".$row['work_activities']."</option>";
										}
										?></select></td><td contenteditable='true' class='item_previous'><input type='number' name='item_previous' placeholder='Previous'  class='form-control'></td><td contenteditable='true' class='item_actual'><input type='number' name='item_actual' placeholder='Actual' class='form-control'></td><td contenteditable='true' class='item_challenges'><input type='text' name='item_challenges' placeholder='Challenges' class='form-control'></td><td  contenteditable='true' class='item_date'><input type='date' name='item_date' required value='<?php echo $date ?>' ></td><td><button type='button' name='remove' data-row='row${count}' class='btn btn-danger btn-xs remove'>-</button></td></tr>`;
   $('#crud_table').append(html_code);
 });
 
 $(document).on('click', '.remove', function(){
  var delete_row = $(this).data("row");
  $('#' + delete_row).remove();
 });
 
 $('#save').click(function(){
  var item_name = [];
  var item_file = [];
  var item_previous = [];
  var item_actual = [];
  var item_challenges = [];
  var item_date = [];

  
  $('.item_name').each(function(){
   item_name.push($(this).find('select').val());
});

  $('.item_previous').each(function(){
   item_previous.push($(this).find('input').val());
  });

  $('.item_actual').each(function(){
   item_actual.push($(this).find('input').val());
  });

  $('.item_challenges').each(function(){
   item_challenges.push($(this).find('input').val());
  });
  $('.item_date').each(function(){
   item_date.push($(this).find('input').val());

});

  $.ajax({
   url:"insert.php",
   method:"POST",
   data:{item_name:item_name, item_previous:item_previous, item_actual:item_actual, item_challenges:item_challenges, item_date:item_date},
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
		$update_status_sql="update work_accomplished set status='$status' where id='$id'";
		mysqli_query($con,$update_status_sql);
	}
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from work_accomplished where id='$id'";
		mysqli_query($con,$delete_sql);
	}
}
?>

<?php
$sql="select * from work_accomplished order by id desc";
$res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Work Accomplished </h4>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>ID</th>
							   <th>Activities</th>
							   <th>Previous %</th>
							   <th>Actual %</th>
							   <th>Challenges</th>
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
							   <td><?php echo $row['item_name']?></td>
							   <td><?php echo $row['item_previous']?></td>
							   <td><?php echo $row['item_actual']?></td>
							   <td><?php echo $row['item_challenges']?></td>
							   <td><?php echo $row['item_date']?></td>
							   <td>
								<?php
								if($row['status']==1){
									echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp;";
								}else{
									echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
								}
								echo "<span class='badge badge-edit'><a href='add_work_acc.php?id=".$row['id']."'>Edit</a></span>&nbsp;";
								
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

