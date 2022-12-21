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


      <tbody>
      <!--  -->
      <!-- <tr>
      <td contenteditable="true" class="item_name" > 
        <select class="form-control" name="work_activities_id">
										<option selected>Select activity</option> -->
										<?php
										/*$res=mysqli_query($con,"select id,work_activities from work_activities order by id asc");
										while($row=mysqli_fetch_assoc($res)){
											// if($row['id']==$categories_id){
												echo "<option  value=".$row['id'].">".$row['work_activities']."</option>";
											// }else{
											// 	echo "<option value=".$row['id'].">".$row['work_activities']."</option>";
											// }
										}*/
										?>
									</select></td>
      <!-- <td contenteditable="true" class="item_file"><input type="file" name="file" class="form-control" <?php //echo  $file_required?>></td> -->

      <!-- <td contenteditable="true" class="item_previous"><input type="number" name="item_previous" placeholder="Previous completion" class="form-control"><?php //echo $previous?></td>

      <td contenteditable="true" class="item_actual"><input type="number" name="item_actual"  placeholder="Actual completion" class="form-control" required><?php //echo $actual?></td>

      <td contenteditable="true" class="item_challenges"><input type="text"  name="item_challenges" placeholder="Challenges" class="form-control" required><?php //echo $challenges?></td>

      <td contenteditable="true" class="item_date"><input type="date" name="item_date" placeholder="Enter reporting date"  required value="<?php //echo $date?>"></td>
    
     </tr> -->


      <!--  -->
     </tbody>
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
//    $.ajax({
//    url:"fetch.php",
//    method:"POST",
//    success:function(data)
//    {
//     $('#crud_table').append(html_code);
//    }
//   })
 var count = 1;
   var id = 0;

 $('#add').click(function(){
    //var arr = ['A','B','C','D'];
  count = count + 1;
  
  var htmls_option = ``;
  var html_code = ``;
 $.ajax({
      type:"GET",
      url: "option-fetch.php",
      data: 'json',
      success: function(res){
         //console.log(res);
      //    res.forEach({
      //       re => htmls_option += "<option>"+re+"</option>"
      // });
       //res = Array.from(res);
      // $('#fname').html(res.fname);
      // $('#lname').html(res.lname);
      // $('#email').html(res.email);
      console.log(res)
      console.log(res.length)

      var result = res.slice(1,-1);
      console.log(result);

      var nameArr = result.split(',');
      console.log(nameArr);

      nameArr.forEach(
            (re) => {
               //console.log(`<option>${re.slice(1,-1)}</option>`);
               htmls_option += `<option>${re.slice(1,-1)}</option>`;
               }
      );
      //console.log(htmls_option);
      // const obj = JSON.parse(res);
      // console.log(res);
   }
   });
   html_code += `<tr id="row${count}"><td  contenteditable="true" class="item_name"><select class="form-control" name="item_name"><option selected>Select activity</option>
										<?php
										$res=mysqli_query($con,"select id,work_activities from work_activities order by id asc");
										while($row=mysqli_fetch_assoc($res)){
											// if($row['id']==$categories_id){
												echo "<option  value=".$row['work_activities'].">".$row['work_activities']."</option>";
											// }else{
											// 	echo "<option value=".$row['id'].">".$row['work_activities']."</option>";
											// }
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

console.log(item_name);

console.log(item_previous);

console.log(item_actual);

console.log(item_challenges);

console.log(item_date);

  $.ajax({
   url:"insert.php",
   method:"POST",
   data:{item_name:item_name, item_previous:item_previous, item_actual:item_actual, item_challenges:item_challenges, item_date:item_date},
   success:function(data){
    alert(data);
    //$("td[contentEditable='true']").text("");
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
require('footer.inc.php');
?>

