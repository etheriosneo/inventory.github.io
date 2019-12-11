<?php 

include_once 'connectdb.php';

session_start();

include_once 'header.php';

if(isset($_POST['addproductbtn'])){
    
    $productname = $_POST['productname'];
    $category = $_POST['category'];
    $purchaseprice = $_POST['purchaseprice'];
    $sellingprice = $_POST['sellingprice'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];
    
    
    $f_name = $_FILES['myfile']['name'];
    $f_tmp = $_FILES['myfile']['tmp_name'];
   
    
    
    $f_size = $_FILES['myfile']['size'];
        
    $f_extension = explode('.', $f_name);
    $f_extension = strtolower(end($f_extension));
    
    $f_newfile = uniqid().'.'.$f_extension;
     $store = "productimages/".$f_newfile;
    
    if($f_extension == 'jpg' || $f_extension == 'jpg' || $f_extension == 'png' || $f_extension == 'gif'){
        
        if($f_size >= 1000000){
            
            
            $error = '<script type="text/javascript">
        
        jQuery(function validation(){
        
        swal({
              title: "Error!",
              text: "Max file size should be 1MB",
              icon: "warning",
              button: "Ok",
              });
        
        });
        
        </script>';
            
        echo $error;
            
            
        }
        else{
            
            if(move_uploaded_file($f_tmp, $store)){
                
                $productimage = $f_newfile;
            }
        }
    }
    
    else{
        
        $error = '<script type="text/javascript">
        
        jQuery(function validation(){
        
        swal({
              title: "Error!",
              text: "Only jpg, png and gif files allowed",
              icon: "error",
              button: "Ok",
              });
        
        });
        
        </script>';
            
        echo $error;

    }
    
    if(!isset($error)){
        
        $insert = $pdo->prepare("insert into product(pname, pcategory, purchaseprice, sellingprice, pstock, pdescription, pimage) values (:pname, :pcategory, :purchaseprice, :sellingprice, :pstock, :pdescription, :pimage)");
        
        $insert->bindParam(':pname', $productname);
        $insert->bindParam(':pcategory', $category);
        $insert->bindParam(':purchaseprice', $purchaseprice);
        $insert->bindParam(':sellingprice', $sellingprice);
        $insert->bindParam(':pstock', $stock);
        $insert->bindParam(':pdescription',$description);
        $insert->bindParam(':pimage', $productimage);
        
        if($insert->execute()){
            
            echo '<script type="text/javascript">
        
        jQuery(function validation(){
        
        swal({
              title: "Success",
              text: "Product Added",
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
              text: "Add product failed",
              icon: "error",
              button: "Ok",
              });
        
        });
        
        </script>';
        }
        
    }
}

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Product
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

        <div class="box box-warning">
        
            <div class="box-header with-border">
            
            
                <h3 class="box-title"><a href="productlist.php" class="btn btn-primary" role="button">Back to product list</a></h3>
            </div>
            <form action="" method="post" name="formproduct" enctype="multipart/form-data">
            <div class="box-body">
            
                <div class="col-md-6">
                
                    <div class="form-group">
                  <label for="exampleInputEmail1">Product Name</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="productname" required>
                </div>
                  
                    <div class="form-group">
                  <label>Select Category</label>
                  <select class="form-control" name="category">
                      <option value="" disabled selected>Select Category</option>
                      
                      <?php
                      
                      $select = $pdo->prepare("select * from category order by categoryid desc");
                      $select->execute();
                      while($row=$select->fetch(PDO::FETCH_ASSOC)){
                          
                          extract($row)
                              ?>
                      <option><?php echo $row['category'];?></option>
                      <?php
                      }
                      
                      ?>
    
                    
                  </select>
                </div>
                    <div class="form-group">
                  <label for="exampleInputEmail1">Purchase Price</label>
                  <input type="number" min="1" class="form-control" id="exampleInputEmail1" placeholder="Enter purchase price" name="purchaseprice" required>
                </div>
                    
                    <div class="form-group">
                  <label for="exampleInputEmail1">Selling Price</label>
                  <input type="number" min="1" class="form-control" id="exampleInputEmail1" placeholder="Enter selling price" name="sellingprice" required>
                </div>
                </div>
                
                <div class="col-md-6">
                
                     
                    
                    <div class="form-group">
                  <label for="exampleInputEmail1">Stock</label>
                  <input type="number" min="1" class="form-control" id="exampleInputEmail1" placeholder="Enter stock" name="stock" required>
                </div>
                    <div class="form-group">
                  <label>Description</label>
                         <textarea class="form-control" name="description" placeholder="Enter description" rows="4 "></textarea>
                 
                </div>
                    
                     <div class="form-group">
                  <label for="exampleInputEmail1">Product Image</label>
                  <input type="file" class="input-group" id="exampleInputEmail1" name="myfile" required>
                        <p>upload image</p>
                </div>
                    
                </div>
                
            </div>
            <div class="box-footer">
            
                
                
                <button type="submit" class="btn btn-info" name="addproductbtn">Add Product</button>
                
            </div>
                            </form>

        </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php

include_once 'footer.php';

?>