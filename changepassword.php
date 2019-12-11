<?php 

include_once 'connectdb.php';

session_start();

if($_SESSION['useremail'] == ""){
    
    header('location:index.php');
}

if($_SESSION['role'] == "Admin"){

    include_once 'header.php';
}

else{
    
    include_once 'userheader.php';
    
}

if(isset($_POST['btnupdate'])){
    
    $old_password = $_POST['oldpassword'];
    $new_password = $_POST['newpassword'];
    $confirm_password = $_POST['confirmpassword'];
    
    
    $email =$_SESSION['useremail'];
    
    $select = $pdo->prepare("select * from user where useremail ='$email'");
    $select->execute();
    
    $row = $select->fetch(PDO::FETCH_ASSOC);
    
    $db_email = $row['useremail'];
    $db_password = $row['password'];
    
    if($old_password == $db_password){
        
        if($confirm_password == $new_password){
            
            $update = $pdo->prepare("update user set password=:password where useremail=:email");
            $update->bindParam(':password',$confirm_password);
            $update->bindParam(':email',$email);
            
            if($update->execute()){
                
                echo '<script type="text/javascript">
        
        jQuery(function validation(){
        
        swal({
              title: "Success",
              text: "Your password has been updated",
              icon: "success",
              button: "Ok",
              });
        
        });
        
        </script>';
                
            }
            
            
        }
        
        else{
                
                echo '<script type="text/javascript">
        
        jQuery(function validation(){
        
        swal({
              title: "Warning",
              text: "Your new passwords dont match",
              icon: "warning",
              button: "Ok",
              });
        
        });
        
        </script>';
                
            }

        
    }
    
    else{
        echo '<script type="text/javascript">
        
        jQuery(function validation(){
        
        swal({
              title: "Warning!",
              text: "Please enter the correct password",
              icon: "warning",
              button: "Ok",
              });
        
        });
        
        </script>';
    }

     
}

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Reset Password
        <small></small>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Password Reset Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Old Password</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Password" name="oldpassword" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">New Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="newpassword" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Confirm Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="confirmpassword" required>
                </div>
                
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="btnupdate">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php

include_once 'footer.php';

?>