<?php
session_start();
require('connection.php');
require('functions.inc.php');
?>

<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Project Reporting Sysytem</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="assets/css/normalize.css">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/themify-icons.css">
      <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
      <link rel="stylesheet" href="assets/css/flag-icon.min.css">
      <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
      <link rel="stylesheet" href="assets/css/style.css">
      <link href="images/bup.png" rel="icon" >
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   </head>
   <script type="text/javascript"> //<![CDATA[
  var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.trust-provider.com/" : "http://www.trustlogo.com/");
  document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
//]]></script>
<script language="JavaScript" type="text/javascript">
  TrustLogo("https://www.positivessl.com/images/seals/positivessl_trust_seal_sm_124x32.png", "POSDV", "none");
</script>
   <body>
      <aside id="left-panel" class="left-panel">
         <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
               <ul class="nav navbar-nav">
                  <li class="menu-title">Menu</li>
                  <li class="menu-item-has-children dropdown">
                     <a href="Project Information.php" > Project Information</a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="update_activities.php" > Work Activities</a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="add_work_acc.php" > Work Accomplished</a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="update_materials.php" > Material Received</a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="update_matl_inventory.php" > Material Used</a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="other_report_details.php" >Report Details</a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="report_pictures.php" > Report Pictures</a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="report_summary.php" target="_blank">Report Summary</a>
                  </li>
                  <li class="menu-item-has-children dropdown">
                     <a href="general_material_inventory.php" target="_blank">Material/Work Analysis</a>
                  </li>
                  <!-- <li class="menu-item-has-children dropdown">
                     <a href="#" > Projected Activities/Materials</a>
                  </li> -->
               </ul>
            </div>
         </nav>
      </aside>
      <div id="right-panel" class="right-panel">
         <header id="header" class="header">
            <div class="top-left">
               <div class="navbar-header">
                  <a class="navbar-brand" href="index.php"><img src="images/bup.png" alt="logo" height ="30" width = "75"></a>
                  <!-- <a class="navbar-brand hidden" href="index.php"><img src="images/bup.png" alt="logo" height ="30" width = "30"></a> -->
                  <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
               </div>
            </div>
            <div class="top-right">
               <div class="header-menu">
               <ul class="navbar-nav px-3">
         <li class="nav-item text-nowrap">
         <a class="nav-link" href="logout.php">Hi <?php echo ucwords($_SESSION['firstname']); ?>, Logout</a>
         </li>
          </ul>
               </div>
            </div>
         </header>