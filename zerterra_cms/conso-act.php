<?php
session_start();
if(!isset($_SESSION["admin"]))
{
 header("location:../Log-in.php");
}
include '../PagesFunction/connection.php';



?>




<!DOCTYPE html>
<html>
<title>Action Log</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
<link rel="icon" href="../images/plainlogo.png" type="image/x-icon" />
<!-- <link href="assets/css/bulma-calendar.min.css" rel="stylesheet">
  <script src="/assets/js/bulma-calendar.min.js"></script> -->


  <!-- <link rel="stylesheet" href="sass/request.css"> -->
  <link rel="stylesheet" href="sass/consoAct.css">
  <body>

    <?php
    include 'Pages/consologViewPage.php'; 
    include 'admin-header.php';
    include 'Buttons/consoLogSearch.php'
    ?>



    <div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-left" style="width:200px;" id="mySidebar">
      <button class="w3-bar-item w3-button w3-large w3-hide-large" onclick="w3_close()" id="close">&times;</button>
      <a href="index.php" class="w3-bar-item w3-button" id="item-hover" ><i class="fas fa-th-large"></i> &nbsp Dashboard</a>
      <a href="admin.php" class="w3-bar-item w3-button" id="item-hover"> <i class="fas fa-user-shield"></i> &nbsp Admin</a>
      <a href="users.php" class="w3-bar-item w3-button" id="item-hover"><i class="fas fa-user"></i> &nbsp Users</a>
      <a class="w3-bar-item w3-button w3-dropdown-hover modal-button" id="sendmodal" data-target="#ordersModal" aria-haspopup="true"><i class="fas fa-cubes"></i> &nbsp Orders</a>
      <a href="request.php" class="w3-bar-item w3-button" id="item-hover"><i class="fas fa-envelope-open-text"></i> &nbsp Request</a>
      <a href="sales.php" class="w3-bar-item w3-button" id="item-hover"><i class="fas fa-hand-holding-usd"></i> &nbsp Sales</a>
      <a href="actionLog.php" class="w3-bar-item w3-button" id="item-hover"><i class="fas fa-clipboard-list"></i> &nbsp Action Log</a>
      <button onclick="document.getElementById('id01').style.display='block'" href="consolidate.php" class="w3-bar-item w3-button" id="dashboard" ><i class="fas fa-print"></i> &nbsp Consolidate</button>
        <a href="../zerterraph_user/logout.php" class="w3-bar-item w3-button" id="item-hover"><i class="fas fa-sign-out-alt"></i>&nbsp Logout</a> 
    </div>

    <a href="print/activitylog.php"><button  class="button" id="home" ><i class="fas fa-print"></i> </button></a> 
  
    <div class="w3-main" style="margin-left:200px">
      <div class="w3-teal">
        <button class="w3-button w3-teal w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</button>
      </div>

     

      <div class="w3-container">
        <div class="columns">
          <div class="column">
            <h1 class="button-category">ACTIVITY LOG</h1>
          </div>
        </div>

        <!--  -->
        <form action="print/activitylogPrint.php" method="GET">
     <!--  -->
     <div class="columns">
      <div class="column is-3" id="base">
    <p id="startD">Start-date</p>
     <box id="cal"><i class="far fa-calendar-alt"></i><input type="text" name="from_date" id="from_date" class="form-control" value="2020/01/01" /></box>
     </div>
     <div class="column is-1" > TO </div>
     <div class="column is-3" id="base">
    <p id="endD">End-date</p>
     <box id="cal"><i class="far fa-calendar-alt"></i><input type="text" name="to_date" id="to_date" class="form-control"  value="<?php echo date('Y/m/d'); ?>" />  </box>
     </div>
     <div class="column">
        <button class="button is-primary" type="button" value="" id="filter"><i class="fas fa-filter"></i> &nbspFilter</button>
      </div>
  </div>
  <button  class="button" id="home" ><i class="fas fa-print"></i> </button>
    <!--  -->
    </form>

        <!--  -->

        <section class = "section">
          <div class = "container"> 

           <table class = "table">
            <thead>
             <tr>
              <th>Author</th>
              <th>Action</th>
              <th>Date Action</th>

              
            </tr>
          </thead>

          <?php 

          if (isset($_POST['search_btn'])){
            $searchValue = $_POST['searchValue'];

            if ($searchValue===''){
              echo '<script>window.location.href="?"</script>';
            }else{
             include 'searchFunction/consoactionLogFunction.php';
           }
         }else{     
                   $sql = "SELECT * FROM tbl_activity_log  ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";

          $res_data = $con->query($sql);
          while($row = mysqli_fetch_array($res_data)){
             $id = $row['id'];
    $author = $row['AdminName'];
    $action = $row['Description'];
    $dateAction = $row['DateAction'];
            
            ?>
        
        <tbody>
              <tr>
              
                <td>
                  <?php echo $author; ?>
                </td>
                <td>
                  <?php echo $action; ?>
                </td>
                <td>
                  <?php echo $dateAction; ?>
                </td>
        
              </tr>
              
              
              <?php 
            }  
          }        
          ?>

      </tbody>
    </table>
    <nav class="pagination is-small" role="navigation" aria-label="pagination">
      <a href="<?php if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1); } ?>" class="pagination-previous" >Previous</a>
      <a href="<?php if($page >= $total_pages){ echo '#'; } else { echo "?page=".($page + 1); } ?>" class="pagination-next">Next page</a>
      <ul class="pagination-list">
        <li><a href="?page=1" class="pagination-link" >1</a></li>
        <li>
          <span class="pagination-ellipsis">&hellip;</span>
        </li>
        <li><a href="?page=<?php echo $total_pages; ?>" class="pagination-link"><?php echo $total_pages; ?></a></li>
      </ul>
    </nav>
  </div>
</section>

</div>


<!-- modal transaction -->

<div class="container" id="modal-container">

  <div id="ordersModal" class="modal  modal-fx-slideTop">
    <div class="modal-background"></div>
    <div class="modal-content1">
     <div class="modal-card1">

      <section class="modal-card-body1" id="modal-card-body">
        <!-- Content ... -->
        <div class="field">
          <div class="control">
            <div class="card" id="modal-card">
              <div class="card-content" id="trans-content">
                <button class="modal-close" id="close9"></button>
                <div class="columns is-mobile">
                  <div class="column is-6">
                    <a href="pending.php">
                      <div class="card" id="card-pending" style="background:url(images/pendingIcon.png);  background-size: 100% 100%; background-repeat: no-repeat; background-size: cover;">
                       <!-- PENDING -->
                     </div>
                   </a>
                 </div>
                 <div class="column is-6">
                  <a href="approved.php">
                    <div class="card" id="card-approve" style="background:url(images/approvedIcon.png);  background-size: 100% 100%; background-repeat: no-repeat; background-size: cover;">
                        <!-- <div class="card-content" >
                          <a href="approved.php" id="pending">
                            APPROVED
                          </a>
                        </div> -->
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <!-- <button class="button is-success is-medium"  aria-label="close" id="close9">Close</button> -->
          </div>
        </section>

      </div>
    </div>
  </div>





  <!-- Modal -->



  <?php
  include 'ordersModal.php';
  ?>


  <?php
  include 'consolidate.php';
  ?>

  



  <!-- modal script -->

  <!-- end script -->

  <script>
    function w3_open() {
      document.getElementById("mySidebar").style.display = "block";
    }
    function w3_close() {
      document.getElementById("mySidebar").style.display = "none";
    }
    document.querySelectorAll('.modal-button').forEach(function(el) {
      el.addEventListener('click', function() {
        var target = document.querySelector(el.getAttribute('data-target'));

        target.classList.add('is-active');

        target.querySelector('.modal-close').addEventListener('click', function(){
          target.classList.remove('is-active');
        });
      });
    });
  </script>

<script>  
      $(document).ready(function(){  
           $.datepicker.setDefaults({  
                dateFormat: 'yy-mm-dd'   
           });  
           $(function(){  
                $("#from_date").datepicker();  
                $("#to_date").datepicker();  
           });  
           $('#filter').click(function(){  
                var from_date = $('#from_date').val();  
                var to_date = $('#to_date').val();  
                if(from_date != '' && to_date != '')  
                {  
                     $.ajax({  
                          url:"consoLogFilter.php",  
                          method:"POST",  
                          data:{from_date:from_date, to_date:to_date},  
                          success:function(data)  
                          {  
                               $('#order_table').html(data);  
                          }  
                     });  
                }  
                else  
                {  
                     alert("Please Select Date");  
                }  
           });  
      });  
 </script>

</body>
</html>
