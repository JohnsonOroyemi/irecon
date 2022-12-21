<?php


session_start();
require('connection.php');


if(isset($_POST["item_name"]))
{
 $item_name = $_POST["item_name"];
 $item_previous = $_POST["item_previous"];
 $item_actual = $_POST["item_actual"];
 $item_challenges = $_POST["item_challenges"];
 $item_date = $_POST["item_date"];
 $query = '';

//  print_r($item_name);
//  print_r($item_previous);
//  print_r($item_actual);
//  print_r($item_challenges);
//  print_r($item_date);


 for($count = 0; $count<count($item_name); $count++)
 {
  $item_name_clean = mysqli_real_escape_string($con, $item_name[$count]);
  $item_previous_clean = mysqli_real_escape_string($con, $item_previous[$count]);
  $item_actual_clean = mysqli_real_escape_string($con, $item_actual[$count]);
  $item_challenges_clean = mysqli_real_escape_string($con, $item_challenges[$count]);
  $item_date_clean = mysqli_real_escape_string($con, $item_date[$count]);

// print_r($item_name_clean);
//  print_r($item_previous_clean);
//  print_r($item_actual_clean);
//  print_r($item_challenges_clean);
//  print_r($item_date_clean);

  if($item_name_clean != '' &&  $item_previous_clean!= '' &&   $item_actual_clean != '' &&  $item_challenges_clean != '' && $item_date_clean != '')
  {
   $query .= 'INSERT INTO work_accomplished (item_name, item_previous, item_actual, item_challenges, item_date, PostedBy, status)VALUES("'.$item_name_clean.'", "'.$item_previous_clean.'", "'.$item_actual_clean.'", "'.$item_challenges_clean.'", "'.$item_date_clean.'", "'.$_SESSION["user_id"].'","1");';
  }

 }
 if($query != '')
 {
  if(mysqli_multi_query($con, $query))
  {
   echo 'Work activities updated'; 
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
