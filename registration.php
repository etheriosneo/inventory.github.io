<?php 

include_once 'connectdb.php';

session_start();

if($_SESSION['useremail'] == "" OR $_SESSION['role'] == "User"){
    
    header('location:index.php');
}

include_once 'header.php';

error_reporting(0);
$id = $_GET['id'];
$delete = $pdo->prepare("delete from user where userid=".$id);
if($delete->execute()){
    
    echo '<script type="text/javascript">
        
        jQuery(function validation(){
        
        swal({
              title: "Success",
              text: "User Deleted!",
              icon: "success",
              button: "Ok",
              });
        
        });
        
        </script>';
}

if(isset($_POST['savebtn'])){
    
    $username = $_POST['username'];
    $useremail = $_POST['useremail'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    
    if(isset($_POST['useremail'])){
        
        $select = $pdo->prepare("select useremail from user where useremail='$useremail'");
        $select->execute();
        if($select->rowCount() >0 ){
            
            echo '<script type="text/javascript">
        
        jQuery(function validation(){
        
        swal({
              title: "Error!",
              text: "User with same email exist",
              icon: "error",
              button: "Ok",
              });
        
        });
        
        </script>';
        }
        
        else{
            
            $insert = $pdo->prepare("insert into user (username, useremail, password, role) values (:name, :email, :pass, :role)");
            $insert->bindParam(':name', $username);
            $insert->bindParam(':email', $useremail);
            $insert->bindParam(':pass', $password);
            $insert->bindParam(':role', $role);
            
            if($insert->execute()){
                
                echo '<script type="text/javascript">
        
        jQuery(function validation(){
        
        swal({
              title: "Success",
              text: "User Created!",
              icon: "success",
              button: "Ok",
              });
        
        });
        
        </script>';
            }
            
            else{
                
                echo '<script type="text/javascript">
        
        jQuery(function validation(){
        
        swal({
              title: "Error!",
              text: "User creation failed",
              icon: "error",
              button: "Ok",
              });
        
        });
        
        </script>';
            }
        }
    }
}

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Registration
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
        <div class="col-md-4">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Registration</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="post">
              <div class="box-body">
                  <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="username" required>
                </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="useremail" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required>
                </div>
                <!-- select -->
                <div class="form-group">
                  <label>Select Role</label>
                  <select class="form-control" name="role">
                      <option value="" disabled selected>Select Role</option>
                      <option>Admin</option>
                    <option>User</option>
                    
                  </select>
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-info" name="savebtn">Save</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
            </div>
        <div class="col-md-8">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    
                    $select = $pdo->prepare("select * from user order by userid desc");
                    $select->execute();
                    while($row=$select->fetch(PDO::FETCH_OBJ)){
                        
                        echo '<tr>
                        <td>'.$row->userid.'</td>
                        <td>'.$row->username.'</td>
                        <td>'.$row->useremail.'</td>
                        <td>'.$row->password.'</td>
                        <td>'.$row->role.'</td>
                        <td><a href="registration.php?id='.$row->userid.'"><span class="glyphicon glyphicon-trash title="delete"></span></a></td>
                        </tr>';
                    }
                    
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php

include_once 'footer.php';

?>