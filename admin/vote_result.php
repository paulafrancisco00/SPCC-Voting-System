<?php

//Include authentication
require("process/auth.php");

//Include database connection
require("../config/db.php");

//Include class Organization
require("classes/Organization.php");

//Include class Position
require("classes/Position.php");

//Include class Nominees
require("classes/Nominees.php");

?>
<?php
include('sidebar.php');
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Login</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style_admin.css">

    <style>
        @media print {
            .noprint {
                display: none;
            }
            /*
            .dataTables_length, .dataTables_filter, .dataTables_info, ul.pagination {
                display: none;
            }
            */
        }
    </style>
</head>
<body>
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="noprint">
                <h3>Select Party List</h3><hr>
                <div class="form-group">
                    <label for="partylist">Party List</label>
                    <select id="partylist" class="form-control">
                        <option value="" selected hidden>Select Party List</option>
                        <option value="ALL">Show All</option>
                        <option value="LIKE">LIKE</option>
                        <option value="OPPA">OPPA</option>
                    </select>
                </div>

                <button  class="btn btn-outline-primary pull-right btnPrint" style="margin-right: 10px !important;" >Export Results</button>  
                <button  class="btn btn-outline-danger" data-toggle="modal" data-target="#DeleteToArchivedVotes">Move All Data to Archived</button> 
                </div> 
                
                <br><br>

                <div id="results">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeleteToArchivedVotes">
        <div class="modal-dialog">
            <div class="modal-content border border-danger">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-danger">WARNING!</h4><hr>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <h5>You are about to Delete All Votes including Party List, Positions and Nominees! All the data will be not recoverable but sent to Archived Voters. Do you still want to delete votes?</h5>

                    <p class="text-danger"><b>Note: </b>Deleted data will not recoverable.</p>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <form method="POST" action="delete_all_votes.php" role="form">
                        <input type="submit" name="submit" class="btn btn-danger" value="Delete">
                    </form>
                    <form>
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                </form>
                </div>

            </div>
        </div>
    </div>
    <script>
        $("#partylist").change(function(){
            console.log(partylist = $(this).val());
            $.ajax({
                url: 'showresult.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    key: 'showresult',
                    partylist: partylist
                }, error: function(err) {
                    alert(err);
                }, success: function(response) {
                    $("#results").html(response);
                    $('.btnPrint').removeAttr('hidden');
                }
            });
        });

        $('.btnPrint').click(function(){
            var printme = document.getElementById('results');
            var wme = window.open(window.print());
            wme.document.write(printme.outerHTML);           
            wme.document.close();
            wme.focus();        
            wme.close();
        });
    </script>
</body>
</html>