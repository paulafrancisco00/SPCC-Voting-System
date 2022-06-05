<?php

include('../assets/tags.php');

?>


<style>
  .nav-link {
    color: white !important;
    font-size: 14px;
  }
  .nav-link:hover {
    color: #f9ae17 !important;
  }
  .dropdown-item {
    font-size: 14px;
  }
  .navbar-brand {
    font-size: 16px;
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
    <img src="../spcclogo.png" width="35">&nbsp;    
  <a class="navbar-brand" href="admin_page.php">SPCC Voting System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
    </ul>
    <ul class="navbar-nav ml-auto">    
      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Manage Candidate's Info
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="add_org.php">Party List</a>
        <a class="dropdown-item" href="add_pos.php">Positions</a>
        <a class="dropdown-item" href="add_nominees.php">Nominees</a>
      </div>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Manage Voter's Info
      </a>
      <div class="dropdown-menu">
<!--
        <a class="dropdown-item" href="add_grade.php">Manage Voter's Grade</a>
        <a class="dropdown-item" href="add_strand.php">Manage Voter's Strand</a>
      -->
        <a class="dropdown-item" href="add_section.php">Voter's Section</a>
        
        <a class="dropdown-item" href="add_voters.php">Voters</a>
         <!-- 
        <a class="dropdown-item" href="add_voters.php">Print Voters</a>
      <a class="dropdown-item" href="add_archived_voters.php">Manage Archived Voters</a> -->
      </div>
    </li>

     <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Manage Archived Page
      </a>
      <div class="dropdown-menu">
<!--
        <a class="dropdown-item" href="add_grade.php">Manage Voter's Grade</a>
        <a class="dropdown-item" href="add_strand.php">Manage Voter's Strand</a>
      -->
        <a class="dropdown-item" href="add_archived_voters.php">Archived Voters</a>
         <a class="dropdown-item" href="archived_vote_result.php">Archived Votes</a>
       
      </div>
    </li>
     <li class="nav-item">
        <a class="nav-link" href="add_votingpage.php">Voting Page</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="vote_result.php">Vote Result</a>
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


