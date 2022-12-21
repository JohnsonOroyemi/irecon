
<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "bupreport");
$output = '';
$query = "SELECT id,work_activities FROM work_activities ORDER BY work_activities ASC";
$result = mysqli_query($connect, $query);
$output = '
<br />
<h3 align="center">Item Data</h3>
<table class="table table-bordered table-striped">
 <tr>
  <th width="30%">Item Name</th>
 </tr>
';
while($row = mysqli_fetch_assoc($result))
{
 $output .= '
 <tr>
  <td>'.$row["item_name"].'</td>
 </tr>
 ';
}
$output .= '</table>';
echo $output;
?>
						