<?php
session_start();
if(!isset($_SESSION["admin"]))
{
 header("location:../Log-in.php");
}
include '../PagesFunction/connection.php';
// include 'connection.php';
include 'Buttons/pendingButtonFunction.php';

?>


<!DOCTYPE html>
<html>
<title>Pending</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
<link rel="stylesheet" href="sass/pending.css">
<link rel="icon" href="../images/plainlogo.png" type="image/x-icon" />



<body>
  <?php
  include 'Pages/pendingViewPage.php'; 
  include 'admin-header.php';
  include 'Buttons/pendingSearch.php';
  ?>

  <div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-left" style="width:200px;" id="mySidebar">

    <button class="w3-bar-item w3-button w3-large w3-hide-large" onclick="w3_close()" id="close">&times;</button>
    <a href="index.php" class="w3-bar-item w3-button" id="item-hover"><i class="fas fa-th-large"></i> &nbsp Dashboard</a>
    <a href="admin.php" class="w3-bar-item w3-button" id="item-hover"> <i class="fas fa-user-shield"></i> &nbsp
    Admin</a>
    <a href="users.php" class="w3-bar-item w3-button" id="item-hover"><i class="fas fa-user"></i> &nbsp Users</a>
    <a class="w3-bar-item w3-button w3-dropdown-hover" id="sendmodal" ><i class="fas fa-cubes"></i> &nbsp Orders</a>
    <a href="request.php" class="w3-bar-item w3-button" id="item-hover"><i class="fas fa-envelope-open-text"></i>
    &nbsp Request</a>
    <a href="sales.php" class="w3-bar-item w3-button" id="item-hover"><i class="fas fa-hand-holding-usd"></i> &nbspSales</a>
    <a href="actionLog.php" class="w3-bar-item w3-button" id="item-hover"><i class="fas fa-clipboard-list"></i> &nbsp Action Log</a>
    <button onclick="document.getElementById('id01').style.display='block'" href="consolidate.php" class="w3-bar-item w3-button" id="item-hover" ><i class="fas fa-print"></i> &nbsp Consolidate</button>
    <a href="../zerterraph_user/logout.php" class="w3-bar-item w3-button" id="item-hover"><i class="fas fa-sign-out-alt"></i>&nbsp Logout</a> 
  </div>


  <div class="w3-main" style="margin-left:200px">
    <div class="w3-teal">
      <button class="w3-button w3-teal w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</button>
    </div>

    <div class="w3-container">
      <div class="columns">
        <div class="column">
          <h1 class="button-category">PENDING ORDER</h1>
        </div>

        <div class="column">
         <div class="columns">
          <div class="column">  
           <button style="margin-top: 30px ; margin-left: 150px; font-family: unset; font-size:16px;" id="btn-add" class="button is-primary is-small modal-button" data-target="#myModal" aria-haspopup="true">
            <i class="far fa-address-card"></i> &nbspADD PRE-ORDER</button>
          </div>
          <?php include 'Buttons/addPreOrderModal.php';?>
          <div class="column">
            <a href="approved.php">
             <button style="margin-top: 30px ; font-family: unset; font-size:16px;" id="btn-add" class="button is-success is-small">
              <i class="far fa-thumbs-up"></i> &nbspAPPROVED</button>
            </a>
          </div>
        </div>
      </div>
    </div>

    <section class="section">
      <div class="container">
        <table class="table">
          <thead>
            <tr>
              
              <th>Order#</th>
              <th>Firstname</th>
              <th>Lastname</th>
              <th>Email</th>
              <th>Contact #</th>
              <th>Option</th>
            </tr>
          </thead>

          <tbody>
            <?php


            if (isset($_POST['search_btn'])){
              $searchValue = $_POST['searchValue'];

              if ($searchValue===''){
                echo '<script>window.location.href="?"</script>';
              }else{
                include 'searchFunction/searchPendingFunction.php';
              }
            }else{     
              $sql = "SELECT * FROM pending_order_list WHERE is_approved='0' ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
              $res_data = $con->query($sql);
              while($row = mysqli_fetch_array($res_data)){

                $id = $row['id'];
                $orderNum = $row['OrderNumber'];
                $fname = $row['Firstname'];
                $lname = $row['Lastname'];
                $email = $row['Email'];
                $contact = $row['Contact'];
                $address = $row['Address'];
                $message = $row['Message'];
                              
                ?>

                <tr>
                

                 <td>
                  <?php echo $orderNum; ?>
                </td>

                <td>
                  <?php echo $fname; ?>
                </td>

                <td>
                  <?php echo $lname; ?>
                </td>

                <td>
                  <?php echo $email; ?>
                </td>
                <td>
                  <?php echo $contact; ?>
                </td>

                <td>
                  <button data-target="#edit<?php echo $id;?>" class="button is-primary is-small modal-button" id="btn_update" name="btn-update"><i class="far fa-edit"></i>
                  </button>
                  <?php
                  include 'Buttons/pendingEditModal.php';
                  ?>  
                  <button data-target="#view<?php echo $id;?>" class="button is-success is-small modal-button"  id="btn_delete" name="btn-delete"><i class="fas fa-eye"></i>
                  </button>
                  <?php
                  include 'Buttons/pendingApproveModal.php';
                  ?>
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

  <div id="serv-modal1" class="modal  modal-fx-slideTop">
    <div class="modal-background"></div>
    <div class="modal-content1">
      <div class="modal-card1">

        <section class="modal-card-body1" id="modal-card-body">
          <!-- Content ... -->
          <div class="field">
            <div class="control">
              <div class="card" id="modal-card">
                <div class="card-content" id="trans-content">
                  <button class="delete" aria-label="close" id="close9"></button>
                  <div class="columns is-mobile">
                    <div class="column is-6">
                      <a href="pending.php">
                        <div class="card" id="card-pending"
                        style="background:url(images/pendingicon.png);  background-size: 100% 100%; background-repeat: no-repeat; background-size: cover;">
                        <div class="card-content">
                          <a href="pending.php" id="pending">
                            PENDING
                          </a>
                        </div>
                      </div>
                    </a>
                  </div>
                  <div class="column is-6">
                    <a href="approved.php">
                      <div class="card" id="card-approve"
                      style="background:url(images/approvedicon.png);  background-size: 100% 100%; background-repeat: no-repeat; background-size: cover;">
                      <div class="card-content">
                        <a href="approved.php" id="pending">
                          APPROVED
                        </a>
                      </div>
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



<?php
include 'consolidate.php';
?>

<?php
include 'ordersModal.php';
?>


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

          //  target.querySelector('.modal-close').addEventListener('click', function(){
             // target.classList.remove('is-active');

             target.querySelector('.delete').addEventListener('click', function(){
              target.classList.remove('is-active');
            });
           });
  });



</script>



</body>
</html>