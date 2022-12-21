<?php  
 //load_data.php  
 session_start();
 require('connection.php');
 $output = '';  
 if(isset($_POST["brand_id"]))  
 {  
      if($_POST["brand_id"] != '')  
      {  
           $sql1 = "SELECT * FROM material_received WHERE material_rcvd = '".$_POST["brand_id"]."'";  
           $sql2 = "SELECT * FROM material_inventory WHERE material_name = '".$_POST["brand_id"]."'";  
      }  
      else  
      {  
           $sql1 = "SELECT * FROM material_received";
           $sql2 = "SELECT * FROM material_inventory";
      }  
      
      $i='total';
      $result1 = mysqli_query($con, $sql1); 
      $result2 = mysqli_query($con, $sql2); 
     //  $receipttotal = 0;
     //  $usedtotal = 0;
     //  $subtotal1 = $row['quantity'];
     //  $subtotal2 = $row['used'];
     //  $receipttotal += $subtotal1;
     //  $usedtotal += $subtotal2;
       
      $output .=  '<div class="orders"><div class="row"> <div class="col-xl-12"><div class="card"><div class="card-body"><h5 class="box-title">Receipt and Usage</h5></div> <div class="card-body--"><table class="table "><thead><tr><th class="serial">Item</th><th>Receipt</th><th>Usage</th><th>Purpose of Usage</th><th>Date</th></tr></thead><tbody>';

      while($row = mysqli_fetch_array($result1))  
      {   if(isset($_SESSION["user_id"])) { 
          if($row["PostedBy"] === $_SESSION["user_id"]){

               $output .= '<tr><td class="serial">'.$row["material_rcvd"].'</td><td>'.$row["quantity"].'</td><td></td><td></td><td>'.$row["date"].'</td></tr>';

               } 
          }else{
          }    
         
               // echo  '</table></div></div></div></div></div>';        

      }  

      while($row = mysqli_fetch_array($result2))  
      {   if(isset($_SESSION["user_id"])) { 
          if($row["PostedBy"] === $_SESSION["user_id"]){

               $output .= '<tr><td class="serial">'.$row["material_name"].'</td><td></td><td>'.$row["used"].'</td><td>'.$row["purpose"].'</td><td>'.$row["material_date"].'</td></tr>';

               } 
          }else{
          }    
         
            

      }  

     //  while($row = mysqli_fetch_array($result2))  
     //  {   if(isset($_SESSION["user_id"])) { 
     //      if($row["PostedBy"] === $_SESSION["user_id"]){

     //           $output .= '<tr><td class="serial">'.$i.'</td><td>.'$receipttotal'.</td><td>'.$usedtotal'</td><td></td><td></td></tr>';

     //           } 
     //      }else{
     //      }    

     //  }  

      $output .= '</tbody></table></div></div></div></div></div>';
       echo $output;
 }

 ?>  


 