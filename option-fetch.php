<?php
require('connection.php');
// require('functions.inc.php');
$res=mysqli_query($con,"select id, work_activities from work_activities order by id asc");
$arr = array();
 //$id = $_POST['id'];
// $query="SELECT * from customers WHERE id = '" . $id . "'";
// $result = mysqli_query($dbCon,$query);
//$work_activities = mysqli_fetch_array($res);
//print_r($work_activities);
while($row = mysqli_fetch_array($res)){
    //print_r($row);
    $arr[]=$row['work_activities'];
    //echo json_encode($row);
    //echo "<br>";
}
//return $arr;
echo json_encode($arr);
//echo $id;
//print_r($arr);
// if($work_activities) {
// //echo json_encode($work_activities);
// } else {
// echo "Error: " ;//. $sql . "" . mysqli_error($con);
// }
?>