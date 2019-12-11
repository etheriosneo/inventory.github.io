<?php 

include_once 'connectdb.php';

session_start();

include_once 'header.php';
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product List
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
            
            
                <h3 class="box-title">Product List</h3>
            </div>
        </div>
        
        <div class="box-body">
            
            <table id="tableProduct" class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Purchase Price</th>
                    <th>Selling Price</th>
                    <th>Stock</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>View</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    
                    $select = $pdo->prepare("select * from product order by pid desc");
                    $select->execute();
                    while($row=$select->fetch(PDO::FETCH_OBJ)){
                        
                        echo '<tr>
                        <td>'.$row->pid.'</td>
                        <td>'.$row->pname.'</td>
                        <td>'.$row->pcategory.'</td>
                        <td>'.$row->purchaseprice.'</td>
                        <td>'.$row->sellingprice.'</td>
                        <td>'.$row->pstock.'</td>
                        <td>'.$row->pdescription.'</td>
                        <td><img src = "productimages/'.$row->pimage.'" class="img-rounded" width="40px" height="40px"/> </td>
                        <td><a href="registration.php?id='.$row->pid.'"><span class="glyphicon glyphicon-trash title="delete"></span></a></td>
                        <td><a href="registration.php?id='.$row->pid.'"><span class="glyphicon glyphicon-trash title="delete"></span></a></td>
                        <td><a href="registration.php?id='.$row->pid.'"><span class="glyphicon glyphicon-trash title="delete"></span></a></td>
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
<script>

    $(document).ready( function () {
    $('#tableProduct').DataTable({
        "order":[[0,"desc"]]
    });
} );
    
</script>
 <?php

include_once 'footer.php';

?>