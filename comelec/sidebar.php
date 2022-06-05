<?php

include('../assets/tags.php');

?>


<style>
  .nav-link {
    color: white !important;
  }
  .nav-link:hover {
    color: #f9ae17 !important;
  }
/*
  .navbar-dark .nav-item > .nav-link.active  {
    color:#f9ae17 !important;
  }

  .navbar-dark .nav-item > .nav-link.active  {
    color:#f9ae17 !important;
  }
.navbar-dark .nav-item > .nav-link.active:hover  {
    color:#f99117 !important;
  }
  */



</style>

<nav class="navbar navbar-expand-md  navbar-dark fixed-top" style="background: #003399; zoom: 90%;">
    <img src="../spcclogo.png" width="40">&nbsp;    
  <a class="navbar-brand" href="comelec_page.php">SPCC Voting System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="add_voters.php">Manage Voters</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="add_archived_voters.php">Manage Archived Voters</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="process/logout.php">Log Out</a>
      </li>    

    </ul>

  </div>  
</nav>
<br>

<script>

$('.navbar-nav .nav-link').click(function(){
    $('.navbar-nav .nav-link').removeClass('active');
    $(this).addClass('active');
})
</script>


