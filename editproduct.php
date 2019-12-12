<?php 

include_once 'connectdb.php';

session_start();

if($_SESSION['useremail'] == "" OR $_SESSION['role'] == "User"){
    
    header('location:index.php');
}

include_once 'header.php';

$id = $_GET['id'];

$select = $pdo->prepare("select * from product where pid=$id");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);

$id_db = $row['pid'];

$productname_db = $row['pname'];

$category_db = $row['pcategory'];

$purchaseprice_db = $row['purchaseprice'];

$sellingprice_db = $row['sellingprice'];

$stock_db = $row['pstock'];

$description_db = $row['pdescription'];

$productimage_db = $row['pimage'];


if(isset($_POST['updatebtn'])){
    
    $productname = $_POST['productname'];
    $category = $_POST['category'];
    $purchaseprice = $_POST['purchaseprice'];
    $sellingprice = $_POST['sellingprice'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];

    $f_name = $_FILES['myfile']['name'];

    if(!empty($f_name)){

        $f_tmp = $_FILES['myfile']['tmp_name'];
   
    
    
        $f_size = $_FILES['myfile']['size'];
            
        $f_extension = explode('.', $f_name);
        $f_extension = strtolower(end($f_extension));
        
        $f_newfile = uniqid().'.'.$f_extension;
         $store = "productimages/".$f_newfile;
        
        if($f_extension == 'jpeg' || $f_extension == 'jfif' || $f_extension == 'jpg' || $f_extension == 'png' || $f_extension == 'gif'){
            
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
                    
                $f_newfile;
                    
                    if(!isset($error)){
            
            $$update = $pdo->prepare("update product set pname=:pname, pcategory=:pcategory, purchaseprice=:purchaseprice, sellingprice=:sellingprice, pstock=:pstock, pdescription=:pdescription, pimage=:pimage where pid= $id");

            $update->bindParam(':pname',$productname);
            $update->bindParam(':pcategory',$category);
            $update->bindParam(':purchaseprice',$purchaseprice);
            $update->bindParam(':sellingprice',$sellingprice);
            $update->bindParam(':pstock',$stock);
            $update->bindParam(':pdescription',$description);
            $update->bindParam(':pimage',$f_newfile);
            
            if($update->execute()){
                
                echo '<script type="text/javascript">
            
            jQuery(function validation(){
            
            swal({
                  title: "Success",
                  text: "Update Product Successful",
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
                  text: "Update Product Failed",
                  icon: "error",
                  button: "Ok",
                  });
            
            });
            
            </script>';
            }
            
        }
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

    }else{

        $update = $pdo->prepare("update product set pname=:pname, pcategory=:pcategory, purchaseprice=:purchaseprice, sellingprice=:sellingprice, pstock=:pstock, pdescription=:pdescription, pimage=:pimage where pid= $id");

        $update->bindParam(':pname',$productname);
        $update->bindParam(':pcategory',$category);
        $update->bindParam(':purchaseprice',$purchaseprice);
        $update->bindParam(':sellingprice',$sellingprice);
        $update->bindParam(':pstock',$stock);
        $update->bindParam(':pdescription',$description);
        $update->bindParam(':pimage',$productimage_db);

        if($update->execute()){

            $error = '<script type="text/javascript">
        
        jQuery(function validation(){
        
        swal({
              title: "Success!",
              text: "Product updation successful",
              icon: "success",
              button: "Ok",
              });
        
        });
        
        </script>';
            
        echo $error;

        }else{

            $error = '<script type="text/javascript">
        
        jQuery(function validation(){
        
        swal({
              title: "Error!",
              text: "Product updation failed",
              icon: "warning",
              button: "Ok",
              });
        
        });
        
        </script>';
            
        echo $error;

        }

    }
}

$select = $pdo->prepare("select * from product where pid=$id");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);

$id_db = $row['pid'];

$productname_db = $row['pname'];

$category_db = $row['pcategory'];

$purchaseprice_db = $row['purchaseprice'];

$sellingprice_db = $row['sellingprice'];

$stock_db = $row['pstock'];

$description_db = $row['pdescription'];

$productimage_db = $row['pimage'];

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Product
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
              <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $productname_db;?>" placeholder="Enter name" name="productname" required>
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
                  <option <?php if($row['category']==$category_db){ ?> selected="selected"
                  <?php } ?> >
                  <?php echo $row['category'];?></option>
                  <?php
                  }
                  
                  ?>

                
              </select>
            </div>
                <div class="form-group">
              <label for="exampleInputEmail1">Purchase Price</label>
              <input type="number" min="1" class="form-control" id="exampleInputEmail1" value="<?php echo $purchaseprice_db;?>" placeholder="Enter purchase price" name="purchaseprice" required>
            </div>
                
                <div class="form-group">
              <label for="exampleInputEmail1">Selling Price</label>
              <input type="number" min="1" class="form-control" id="exampleInputEmail1" value="<?php echo $sellingprice_db;?>" placeholder="Enter selling price" name="sellingprice" required>
            </div>
            </div>
            
            <div class="col-md-6">
            
                 
                
                <div class="form-group">
              <label for="exampleInputEmail1">Stock</label>
              <input type="number" min="1" class="form-control" id="exampleInputEmail1" value="<?php echo $stock_db;?>" placeholder="Enter stock" name="stock" required>
            </div>
                <div class="form-group">
              <label>Description</label>
                     <textarea class="form-control" name="description" placeholder="Enter description" rows="4 "><?php echo $description_db;?></textarea>
             
            </div>
                
                 <div class="form-group">
              <label for="exampleInputEmail1">Product Image</label>

              <img src = "productimages/<?php echo $productimage_db;?>" class="img-responsive" width="40px" height="40px"/> 

              <input type="file" class="input-group" id="exampleInputEmail1" name="myfile">
                    <p>upload image</p>
            </div>
                
            </div>
            
        </div>
        <div class="box-footer">
            
                
                
            <button type="submit" class="btn btn-warning" name="updatebtn">Update Product</button>
            
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