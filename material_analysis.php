<!---jQuery ajax load rcords using select box --->
<!-- <script type="text/javascript">
  $(document).ready(function(){
      $(".material_rcvd").on("change", function(){
        var cityname = $(this).val();
        if (cityname !== "") {
          $.ajax({
            url : "material_analysis.php",
            type:"POST",
            cache:false,
            data:{cityname:cityname},
            success:function(data){
              $("#show-city").html(data);
            }
          });
        }else{
          $("#show-city").html(" ");
        }
      })
  });
</script> -->


<?php
require('connection.php');
?>
	<?php

 $action = $_REQUEST['action'];
 
 if($action=="showAll"){
  
  $stmt=$con->prepare('SELECT * FROM material_received');
  $stmt->execute();
  
 }else{
  
  $stmt=$con->prepare('SELECT product_id, product_name FROM products WHERE cat_id=:cid ORDER BY product_name');
  $stmt->execute(array(':cid'=>$action));
 }
 
 ?>
 <div class="row">
 <?php
 if($stmt->rowCount() > 0){
  
  while($row=$stmt->fetch(PDO::FETCH_ASSOC))
  {
   extract($row);
 
   ?>
   <div class="col-xs-3">
   <div style="border-radius:3px; border:#cdcdcd solid 1px; padding:22px;"><?php echo $product_name; ?></div><br />
   </div>
   <?php  
  }
  
 }else{
  
  ?>
        <div class="col-xs-3">
   <div style="border-radius:3px; border:#cdcdcd solid 1px; padding:22px;"><?php echo $product_name; ?></div><br />
  </div>
        <?php  
 }
 
 
 ?>
 </div>

	