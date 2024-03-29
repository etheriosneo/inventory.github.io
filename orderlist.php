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
        Admin Dashboard
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
        <form action="" method="post" name="">
            <div class="box-header with-border">
            
            
                <h3 class="box-title">Order List</h3>
            </div>
          
          <div class="box-body">
          
          <div style="overflow-x:auto;">
            <table id="orderlisttable" class="table table-striped">
                <thead>
                <tr>
                    <th>Invoice ID</th>
                    <th>Customer Name</th>
                    <th>Order Date</th>
                    <th>Total</th>
                    <th>Paid</th>
                    <th>Due</th>
                    <th>Payment Type</th>
                    <th>Print</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    
                    $select = $pdo->prepare("select * from invoice order by invoiceid desc");
                    $select->execute();
                    while($row=$select->fetch(PDO::FETCH_OBJ)){
                        
                        echo '<tr>
                        <td>'.$row->invoiceid.'</td>
                        <td>'.$row->customername.'</td>
                        <td>'.$row->orderdate.'</td>
                        <td>'.$row->total.'</td>
                        <td>'.$row->paid.'</td>
                        <td>'.$row->due.'</td>
                        <td>'.$row->paymentype.'</td>
                        <td><a href="viewproduct.php?id='.$row->invoiceid.'"><span class="glyphicon glyphicon-print title="Print Invoice"></span></a></td>
                        <td><a href="editorder.php?id='.$row->invoiceid.'"><span class="glyphicon glyphicon-pencil title="Edit Order"></span></a></td>
                        <td><button id='.$row->invoiceid.' class="btn btn-danger btndelete"><span class="glyphicon glyphicon-trash title="Delete Order"></span></button></td>
                        </tr>';
                    }
                    
                    ?>
                </tbody>
            </table>
        </div>
          
          </div>
        </div>
        </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

    <script>
        $(document).ready( function () {
    $('#orderlisttable').DataTable({
        "order":[[0,"desc"]]
    });
} );
    </script>
 <?php

include_once 'footer.php';

?>