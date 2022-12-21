<?php   
 //load_data_select.php  
 require('top.inc.php');
 
 function fill_brand($con)  
 {  
      $output = '';  
      $sql = "SELECT * FROM materials order by id asc";  
      $result = mysqli_query($con, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<option value="'.$row["materials"].'">'.$row["materials"].'</option>';  
      }  
      return $output;  
 } 
 
 


 function fill_product($con)  
 {  
      $output = '';  
      $sql = "SELECT * FROM material_received";  
      $result = mysqli_query($con, $sql);  

     

      while($row = mysqli_fetch_array($result))  
      {    
          if(isset($_SESSION["user_id"])) { 
          if($row["PostedBy"] === $_SESSION["user_id"]){
           
          $receipttotal = 0;
           $subtotal = $row['quantity'];
           $receipttotal += $subtotal;

           $output .=       '<tbody>';
           $output .=        '<tr>';
           $output .=        '<td>'.$row["material_rcvd"].'</td>';
           $output .=        '<td> '.$row["quantity"].'</td>';
           $output .=        '<td></td>';
           $output .=         '<td></td>';
           $output .=         '<td>'.$row['date'].'</td>';                          
           $output .=        '</tr>';                            
           $output .=          '</tbody>';
          } 
          }else{
          }
     }
      return $output;  
 }

 function fill_usagepurpose($con)  
 {  
      $output = '';  
      $sql = "SELECT * FROM material_inventory";  
      $result = mysqli_query($con, $sql);  

     

      while($row = mysqli_fetch_array($result))  
      {    
          if(isset($_SESSION["user_id"])) { 
          if($row["PostedBy"] === $_SESSION["user_id"]){
           

           $output .=       '<tbody>';
           $output .=        '<tr>';
           $output .=        '<td>'.$row["material_name"].'</td>';
           $output .=        '<td></td>';
           $output .=        '<td> '.$row["used"].'</td>';
           $output .=         '<td> '.$row["purpose"].'</td>';
           $output .=         '<td>'.$row['material_date'].'</td>';                          
           $output .=        '</tr>';                            
           $output .=          '</tbody>';
          } 
          }else{
          }
     }
      return $output;  
 }
 ?>  

 
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Material/Work Analysis</strong><small> </small></div>
						<span><?php if(isset($_GET['r'])){echo $_GET['r'];} ?></span>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="materials" class=" form-control-label"></label>
									<select class="form-control" name="material_rcvd" id="brand">
										<option value="" >All materials</option>
										<?php echo fill_brand($con); ?>  
									</select>
								</div>
							</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>


<div class="content pb-0" id="show_product">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				<h5 class="box-title">Receipt and Usage</h5>
				</div>
        			<div class="card-body--">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">Item</th>
							   <th>Receipt</th>
								<th>Usage</th>
								<th>Purpose of Usage</th>
							   <th>Date</th>
							</tr>
						 </thead>

                               <?php echo fill_product($con);?>  
                               <?php echo fill_usagepurpose($con);?> 
					  </table>
					  <!-- <button id="payment-button" onclick="window.print()" class="btn btn-lg btn-info btn-block"><span id="">Print</span></button> -->
				 </div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
     
 <script>  
 $(document).ready(function(){  
      $('#brand').change(function(){  
           var brand_id = $(this).val();  
           $.ajax({  
                url:"load_data.php",  
                method:"POST",  
                data:{brand_id:brand_id},  
                success:function(data){  
                     $('#show_product').html(data);  
                }  
           });  
      });  
 });  
 </script>  


<!-- $sql = "SELECT id, quantity, date  FROM material_inventory UNION ALL SELECT used, purpose, date FROM material_received WHERE material_rcvd = '".$_POST["brand_id"]."'";   -->

<?php
require('footer.inc.php');
?>
