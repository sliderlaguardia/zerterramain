<?php
include 'connection.php';
       
       if(isset($_POST['btn_add_admin'])){

        $name = $_POST['name'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $contact = $_POST['contact'];
        $Email = $_POST['email'];
        $role = $_POST['role'];
        if($password != $cpassword){
         echo "<script>window.alert('password not matched');</script>";
         
      
       }else{
         $sql = "SELECT * FROM admin_list WHERE Email='$Email'";
         $result = $con->query($sql);
         if($result->num_rows > 0){
          echo "<script>window.alert('Email is already used!');</script>";
        }else{
          $newpass = md5($password);
          $sql ="INSERT INTO admin_list(name,Password,contact,Email,role,is_active) VALUES ('$name','$newpass','$contact','$Email','$role','1')";
          if($con->query($sql) === TRUE){
            echo "<script>window.alert('New Admin is added!');</script>";
          }else{
            echo "<script>window.alert('Saving new record failed!');</script>";
          }
        }
      }
      
      
      
      }

      if(isset($_POST['acnt_remove'])){
        $delete_id = $_POST['delete_id'];
        $role = $_POST['role_id'];
  
        if($role ==='Super Admin'){
          echo "<script>window.alert('THIS RECORD CANNOT BE DELETE!');</script>";
        }else{
  
          $sql= "UPDATE admin_list SET is_active='0' WHERE id='$delete_id'";
          if($con->query($sql) === TRUE){
            echo "<script>window.alert('RECORD IS DELETED!');</script>";
            echo '<script>window.location.href="admin.php"</script>';
          }else{
            echo "<script>window.alert('SOMETHING WENT WRONG, PLEASE TRY AGAIN!');</script>";
          }
        }
      }
  
      if(isset($_POST['updated_id'])){
        $id = $_POST['edit_id'];
        $name = $_POST['edit_name'];
        $contact = $_POST['edit_contact'];
        $email= $_POST['edit_email'];
  
  
  
        $sql = "UPDATE admin_list SET name='$name',contact='$contact',Email='$email' WHERE id='$id'";
        if($con->query($sql) === TRUE){
          echo "<script>window.alert('RECORD IS UPDATED!');</script>";
          echo '<script>window.location.href="admin.php"</script>';
        }else{
          echo "<script>window.alert('SOMETHING WENT WRONG, PLEASE TRY AGAIN!');</script>";
        }
  
  
  
      }
?>