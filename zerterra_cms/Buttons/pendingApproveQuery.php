<?php 
      
      if(isset($_POST['btnapproved'])){
        $edit_id = $_POST['edit_id'];
        $fname = $_POST['edit_fname'];
        $lname = $_POST['edit_lname'];
        $email= $_POST['edit_email'];
        $Address = $_POST['edit_address'];
        $Contact= $_POST['edit_contact'];
        $Message= $_POST['edit_message'];
        // echo "<script>window.alert('$email');</script>";
    
    
    
        $sql = "UPDATE pending_list SET FirstName='$fname',LastName='$lname',Message='$Message', Address='$Address' ,ContactNumber='$Contact',Email='$email', is_pending='1' WHERE id='$edit_id'";
        if($con->query($sql) === TRUE){
    
    
       $sql ="INSERT INTO approve_list(pendingID,FirstName,LastName,Email,ContactNumber,Address,Message) VALUES ('$id','$fname','$lname','$email','$Address','$Contact','$Message')";
              if($con->query($sql) === TRUE){
                
              }else{
                
                echo "<script>window.alert('Saving new record failed!');</script>";
              }
    
          echo "<script>window.alert('RECORD IS UPDATED!');</script>";
          echo '<script>window.location.href="pending.php"</script>';
              } else{
                echo "<script>window.alert('SOMETHING WENT WRONG, PLEASE TRY AGAIN!');</script>";
              }
           
          }
          
?>