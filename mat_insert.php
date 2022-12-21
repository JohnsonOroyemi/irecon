<?php
session_start();
require('connection.php');


if(isset($_POST["material_name"]))
{
 $material_name = $_POST["material_name"];
 $used = $_POST["used"];
 $purpose = $_POST["purpose"];
 $material_date = $_POST["material_date"];
 $query = '';


 for($count = 0; $count<count($material_name); $count++)
 {
  $material_name_clean = mysqli_real_escape_string($con, $material_name[$count]);
  $used_clean = mysqli_real_escape_string($con, $used[$count]);
  $purpose_clean = mysqli_real_escape_string($con, $purpose[$count]);
  $material_date_clean = mysqli_real_escape_string($con, $material_date[$count]);

  if($material_name_clean != '' &&   $used_clean != ''  &&  $purpose_clean != '' &&  $material_date_clean != '')
  {
   $query .= 'INSERT INTO material_inventory (material_name, used, purpose, material_date, PostedBy, status)VALUES("'.str_replace("_", " ", $material_name_clean).'", "'.$used_clean.'", "'.str_replace("_", " ", $purpose_clean).'", "'.$material_date_clean.'", "'.$_SESSION["user_id"].'","1");';
  }

 }
 if($query != '')
 {
  if(mysqli_multi_query($con, $query))
  {
   echo 'Material Inventory updated'; 
   exit();
  }
  else
  {
   echo 'Error'.$con -> error;
   echo 'Error'.mysqli_error($con);
   exit();
  }
 }
 else
 {
  echo 'All Fields are Required';
 }
}
?>
