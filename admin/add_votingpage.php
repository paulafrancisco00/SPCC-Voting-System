<?php

//Include authentication
require("process/auth.php");

//Include database connection
require("../config/db.php");

//Include class Voters
require("classes/Voters.php");


if(isset($_POST['btnvoting'])){
    if($_POST['btnvoting'][0] == 1){
        $val =0;
    }else{
        $val =1;
    }
    $uptsql = "update votingpage set voting ='".$val."'";
    mysqli_query($db,$uptsql);

}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Login</title>
    
</head>
<body>

<!-- Header -->
<?php 
    include('sidebar.php');
?>
<!-- End Header -->



<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
              <?php
                if(isset($_POST['update'])) {
                    $status   = trim($_POST['status']);
                  
                    $updatePos = new Position();
                    $rtnUpdatePos = $updatePos->UPDATE_VOTINGPAGE($status);
                }
                ?>

              <div class="card text-center bg-light mb-3" style="border-color:#007bff !important; ">
                  <div class="card-body">
                        <img src="../spcclogo.png" width="100"><br><br>
                        <h5 class="card-title">Admin's Voting Page Access </h5>
                      <!--  <p class="card-text">You've successfully voted.</p> -->
                      <form method="post">
                        <table class="table table-condensed">
                            <tr>
                                <th>Status</th>
                                <th>School Year</th>
                                <th> Voting</th>
                            </tr>
                            <?php
                                $getsql ="select * from votingpage";
                                $getres = mysqli_query($db,$getsql);
                                while($getrec = mysqli_fetch_assoc($getres)){
                            ?>
                            <tr>
                                <td> <?php echo $getrec['status']; ?></td>
                                <td> <?php echo $getrec['strtyear']."-".$getrec['endyear']; ?></td>
                                <td><button name='btnvoting[]' type='submit' value="<?php echo $getrec['voting'];?>"><span>
                                    <?php 
                                            if($getrec['voting'] == 0){
                                                echo "<span style='color:red;'>CLOSED</span>";
                                            }else{
                                                echo "<span style='color:green;'>OPEN</span>";
                                            }
                                    ?>
                                </span></button></td>

                            </tr>
                            <?php
                                }
                            ?>

                        </table>
                    </form>
                  </div>
                  
            </div>
        </div>
    </div>
</div>

<!-- Footer -->

<nav class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">

    <div class="container">
        <div class="navbar-text pull-left">
            
        </div>
    </div>

</nav>

<!-- End Footer -->



</body>
</html>