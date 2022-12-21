<?php
require('top.inc3.php');

$sql="SELECT * FROM user order by userId desc";
$result=$con->query($sql);
?>

    <!-- Courses -->
   <section id="about">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <div class="section-title">
                              <h2> <small>All Projects</small></h2>
                         </div>
    
                         <?php while($row=$result->fetch_array()){?>
                          
                              <div class="col-md-4 col-sm-4">
                                   <div class="item">
                                        <div class="courses-thumb">
                                             
                                             <a href="all_project.php?id=<?php echo $row['userId']; ?>">
                                             <div class="courses-detail">
                                                  <?php echo ucwords(strtolower($row["projectName"]));?>
                                                  <!-- <p><?php //echo ucwords(strtolower($row["SubHeading"]));?></p> -->
                                             </div>
                                        </div>
                                   </div>
                              </div> 
                              
                              <?php } ?>  
                         
                    </div>

               </div>
          </div> 
     </section>

<br><br><br><br>

 <!-- Footer -->
<?php require('footer.inc.php'); ?>