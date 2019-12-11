<?php 

include_once 'connectdb.php';

session_start();

if($_SESSION['useremail'] == "" OR $_SESSION['role'] == "User"){
    
    header('location:index.php');
}

include_once 'header.php';

if(isset($_POST['savebtn'])){
    
    $category = $_POST['category'];
    
    if(empty($category)){
        
        $error = '<script type="text/javascript">
        
        jQuery(function validation(){
        
        swal({
              title: "Error!",
              text: "Field Empty",
              icon: "error",
              button: "Ok",
              });
        
        });
        
        </script>';
        
        echo $error;
        
    }
    
    if(!isset($error)){
        
        $insert = $pdo->prepare("insert into category (category) values (:category)");
        $insert->bindParam(':category', $category);
        
        if($insert->execute()){
            
            echo '<script type="text/javascript">
        
        jQuery(function validation(){
        
        swal({
              title: "Success!",
              text: "Category created",
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
              text: "Category creation failed",
              icon: "error",
              button: "Ok",
              });
        
        });
        
        </script>';
        }
    }
}

if(isset($_POST['updatebtn'])){
        
        $category = $_POST['category'];
        $categoryid = $_POST['categoryid'];
        
        
    if(empty($category)){
        
        $errorupdate = '<script type="text/javascript">
        
        jQuery(function validation(){
        
        swal({
              title: "Error!",
              text: "Field Empty",
              icon: "error",
              button: "Ok",
              });
        
        });
        
        </script>';
        
        echo $errorupdate;
        
        
    }
    }

if(!isset($errorupdate)){
        
        $update = $pdo->prepare("update category set category=:category where categoryid=".$categoryid);
        $update->bindParam(':category', $category);
        
        if($update->execute()){
            
            echo '<script type="text/javascript">
        
        jQuery(function validation(){
        
        swal({
              title: "Success!",
              text: "Successfully Edited",
              icon: "success",
              button: "Ok",
              });
        
        });
        
        </script>';
        }
    }

if(isset($_POST['deletebtn'])){
    
    $delete = $pdo->prepare("delete from category where categoryid=".$_POST['deletebtn']);
    
    if($delete->execute()){
        
        echo '<script type="text/javascript">
        
        jQuery(function validation(){
        
        swal({
              title: "Success!",
              text: "Successfully Deleted",
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
              text: "Category Not Deleted",
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
        Category
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
<form role="form" action="" method="post">
    
    <?php
    
    if(isset($_POST['editbtn'])){
        
        $select = $pdo->prepare("select * from category where categoryid=".$_POST['editbtn']);
        $select->execute();
        
        if($select){
            
            $row = $select->fetch(PDO::FETCH_OBJ);
            echo '<div class="col-md-4">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Registration</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
                  <div class="form-group">
                  <label for="exampleInputEmail1">Category Name</label>
                  <input type="hidden" class="form-control" id="exampleInputEmail1" value="'.$row->categoryid.'" name="categoryid">
                  <input type="text" class="form-control" id="exampleInputEmail1" value="'.$row->category.'" name="category">
                </div>
                 
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-info" name="updatebtn">Update</button>
              </div>
           
          </div>
          <!-- /.box -->
            </div>';
        }
    }
    
    else{
        
        echo '<div class="col-md-4">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Registration</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
                  <div class="form-group">
                  <label for="exampleInputEmail1">Category Name</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="category">
                </div>
                 
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="savebtn">Save</button>
              </div>
           
          </div>
          <!-- /.box -->
            </div>';
    }
    
    
    
    
    
    
    ?>
      
        <div class="col-md-8">
            <table id="tableCategory" class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    
                    $select = $pdo->prepare("select * from category order by categoryid desc");
                    $select->execute();
                    while($row=$select->fetch(PDO::FETCH_OBJ)){
                        
                        echo '<tr>
                        <td>'.$row->categoryid.'</td>
                        <td>'.$row->category.'</td>
                        <td><button type="submit" value="'.$row->categoryid.'" class="btn btn-success" name="editbtn">Edit</button></td>
                        <td><button type="submit" value="'.$row->categoryid.'" class="btn btn-danger" name="deletebtn">Delete</button></td>
                        </tr>';
                    }
                    
                    ?>
                </tbody>
            </table>
        </div>
 </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script>

    $(document).ready( function () {
    $('#tableCategory').DataTable();
} );
    
</script>
 <?php

include_once 'footer.php';

?>