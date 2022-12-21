<?php
session_start();
require('connection.php');
require('functions.inc.php');
?>
<!Doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Project Reporting Sysytem</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
      <link rel="stylesheet" href="assets/css/report_summary.css">
      <link href="images/bup.png" rel="icon" >
</head>
<body>
  <header>
  <div class="logo">
  <img src="images/bup.png" alt="blueline logo" height="85" width="150" />
  </div>


<?php
$sql="select  user.projectName AS projectName, proj_info.PostedBy AS PostedBy from user INNER JOIN proj_info on proj_info.PostedBy = user.userId where PostedBy =user.userId ";
$res=mysqli_query($con,$sql);
?>
<?php while($row=mysqli_fetch_assoc($res)){?>
  <?php 
							if(isset($_SESSION["user_id"])) { 
							if($row["PostedBy"] === $_SESSION["user_id"]){?>
        <div class="invoiceNbr">
            BLUELINE URBAN PROJECT LTD
            <br/>
              &
            <br>
            <?php echo ucwords(strtoupper($row["projectName"])); ?>
            <br>
        </div>
        <?php }
								}else{
							}
								?>
							
							<?php } ?>
    </header>



<?php
$sql="select CONCAT(user.firstName,' ', user.lastName) AS firstName, user.emailAddress AS emailAddress, user.phoneNumber AS phoneNumber, proj_info.PostedBy AS PostedBy from user INNER JOIN proj_info on proj_info.PostedBy = user.userId where PostedBy =user.userId ";

$res=mysqli_query($con,$sql);
?>

<?php while($row=mysqli_fetch_assoc($res)){?>
  <?php 
							if(isset($_SESSION["user_id"])) { 
							if($row["PostedBy"] === $_SESSION["user_id"]){?>

    <div class="fromto from">
        <div class="panel">FROM:</div>
        <div class="fromtocontent">
            <span><?php echo $row['firstName']?></span><br />
            <span><?php echo $row['emailAddress']?></span><br />
            <span><?php echo $row['phoneNumber']?></span><br />
        </div>
    </div>
    <?php }
								}else{
							}
								?>
                <?php } ?>



    <?php
$sql="select * from  other_report_details where date (date) = date(now())";
$res=mysqli_query($con,$sql);
?>
<?php while($row=mysqli_fetch_assoc($res)){?>
  <?php 
							if(isset($_SESSION["user_id"])) { 
							if($row["PostedBy"] === $_SESSION["user_id"]){?>
    <div class="fromto to">
        <div class="panel">DATE: Thursday, 25/11/2021</div>
        <div class="fromtocontent">
            <span>Report: <?php echo $row['reportno']?> </span><br/>
            <span>Week: <?php echo $row['week']?> </span><br />
            <span>Day: <?php echo $row['daynr']?> </span>
        </div>
    </div>
    <?php }
								}else{
							}
								?>
							
							<?php } ?>

<?php
$sql="select * from  other_report_details where date (date) = date(now())";
$res=mysqli_query($con,$sql);
?>
<?php while($row=mysqli_fetch_assoc($res)){?>
  <?php 
							if(isset($_SESSION["user_id"])) { 
							if($row["PostedBy"] === $_SESSION["user_id"]){?>
<section class="items">
<p><b>WEATHER:</b> <?php echo $row['weather']?> </p> 
<p><b>STAGE OF WORK:</b> <?php echo $row['stageofwork']?></p>
<p><b>VISITOR:</b> <?php echo $row['visitors']?>  </p> 
<p><b>MATERIALS NEEDED ON SITE:</b> <?php echo $row['matlsneeded']?></p> 
<p><b>ACCIDENT:</b> <?php echo $row['accident']?> </p>
<p><b>ATTENDANCE :</b> <?php echo $row['attendance']?></p> 

</section>
<?php }
								}else{
							}
								?>
							
							<?php } ?>


<?php
$sql="SELECT * from work_accomplished where item_date  = date(now()) order by id asc";
$res=mysqli_query($con,$sql);
?>

<section>
  <!--for demo wrap-->
  <h1>Work Accomplished</h1>
  <div class="tbl-header">
    <table cellpadding="0" cellspacing="0" border="0">
      <thead>
        <tr>
        <th>Item</th>
          <th>Work Activities Achieved Today</th>
          <th>Previous % Completion</th>
          <th>Actual % Completion</th>
          <th>Challenges</th>
        </tr>
      </thead>
    </table>
  </div>
  
        
  <div class="">
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody> 
      <?php 
							while($row=mysqli_fetch_assoc($res)){?>
      <tr>
      <?php 
							if(isset($_SESSION["user_id"])) { 
							if($row["PostedBy"] === $_SESSION["user_id"]){?>
							   <td><?php echo $row['id']?></td>
                 <td><?php echo $row['item_name']?></td>
							   <td><?php echo $row['item_previous']?></td>
							   <td><?php echo $row['item_actual']?></td>
							   <td><?php echo $row['item_challenges']?></td>
        <?php }
        }else{
      }
								?>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</section>


<?php
$sql="SELECT * from material_inventory where material_date = date(now()) order by id asc";
$res=mysqli_query($con,$sql);
?>

<section>
  <!--for demo wrap-->
  <h1>Material Inventory</h1>
  <div class="tbl-header">
    <table cellpadding="0" cellspacing="0" border="0">
      <thead>
        <tr>
        <th>Item</th>
          <th>Name</th>
          <th>Used</th>
          <th>Purpose</th>
        </tr>
      </thead>
    </table>
  </div>
  
        
  <div class="">
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody> 
      <?php 
							while($row=mysqli_fetch_assoc($res)){?>
      <tr>
      <?php 
							if(isset($_SESSION["user_id"])) { 
							if($row["PostedBy"] === $_SESSION["user_id"]){?>
							   <td><?php echo $row['id']?></td>
                 <td><?php echo $row['material_name']?></td>
							   <td><?php echo $row['used']?></td>
							   <td><?php echo $row['purpose']?></td>
        <?php }
        }else{
      }
								?>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</section>


<section>
<table>
<?php
$result = $con->query("SELECT * FROM report_pictures where date (uploaded_on) = date (now()) ORDER BY id DESC");

  $count = 0;
  while($res=mysqli_fetch_array($result))
  {
      if($count==3) //three images per row
      {
         print "</tr>";
         $count = 0;
      }
      if($count==0)
         print "<tr>";
      print "<td>";
      ?>
 <img src="<?php echo 'uploads/'.$res['images'];?>" width="350" height="300"/>

          <?php
      $count++;
      print "</td>";
  }
  if($count>0)
     print "</tr>";
  
?>

</table>
</section>

<button id="payment-button" onclick="window.print()" class="btn btn-lg btn-info btn-block">
  <span id="">Print</span>
  </button>

  <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
      <script src="assets/js/report_summary.js" type="text/javascript"></script>
      <script>
</body>
</html>