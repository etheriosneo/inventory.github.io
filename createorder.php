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
       Create Order
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
            
            
                <h3 class="box-title">New Order</h3>
            </div>
          
          <div class="box-body">
          
          <div class="col-md-6">

          <div class="form-group">
              
                  <label>Customer Name</label>
                  
                  <div class="input-group"> 
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter customer name" name="customer" required>
                  </div>
                </div>
          
          </div>
          <div class="col-md-6">

          <div class="form-group">
                <label>Date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker">
                </div>
                <!-- /.input group -->
              </div>

          </div>
          
          
          <div class="box-body">

            <div class="col-md-12">

            <table id="tableProduct" class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Search Product</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th>Enter Quantity</th>
                    <th>Total</th>
                    <th><center><button type="button" name="add" class="btn btn-success btn-sm btnadd"><span class="glyphicon glyphicon-plus"></span></button></center></th>
                    </tr>
                </thead>
            </table>

            </div>

          </div>
          <div class="box-body">

          <div class="col-md-6">

          <div class="form-group">
                  <label>Sub Total</label>
                  <div class="input-group"> 
                  <div class="input-group-addon">
                    <i class="fa fa-usd"></i>
                  </div>
                  <input type="text" class="form-control" name="subtotal" required>
                    </div>
                </div>

          

          <div class="form-group">
                  <label>Tax (5%)</label>
                  <div class="input-group"> 
                  <div class="input-group-addon">
                    <i class="fa fa-usd"></i>
                  </div>
                  <input type="text" class="form-control" name="tax" required>
                    </div>
                </div>

                <div class="form-group">
                  <label>Discount</label>
                  <div class="input-group"> 
                  <div class="input-group-addon">
                    <i class="fa fa-usd"></i>
                  </div>
                  <input type="text" class="form-control" name="discount" required>
                    </div>
                </div>
                </div>

        
          <div class="box-body">
          <div class="col-md-6">

          <div class="form-group">
                  <label>Total</label>
                  <div class="input-group"> 
                  <div class="input-group-addon">
                    <i class="fa fa-usd"></i>
                  </div>
                  <input type="text" class="form-control" name="total" required>
                </div>
                </div>

          

          <div class="form-group">
                  <label>Paid</label>
                  <div class="input-group"> 
                  <div class="input-group-addon">
                    <i class="fa fa-usd"></i>
                  </div>
                  <input type="text" class="form-control" name="paid" required>
                </div>
                </div>

                <div class="form-group">
                  <label>Due</label>
                  <div class="input-group"> 
                  <div class="input-group-addon">
                    <i class="fa fa-usd"></i>
                  </div>
                  <input type="text" class="form-control" name="due" required>
                </div>
                </div>
                <br>

            <!-- radio -->
            <label>Payment Method</label>
            <div class="form-group">
              
                <label>
                  <input type="radio" name="r2" class="minimal-red" checked>CASH
                </label>
                <label>
                  <input type="radio" name="r2" class="minimal-red">CARD
                </label>
                <label>
                  <input type="radio" name="r2" class="minimal-red">CHECK
               
                </label>
              </div> 
          </div>
            
          </div>

            
        <hr>
        <div align="center">

        <input type="submit" name="saveorder" value="Save Order" class="btn btn-info">
        </div>
        <hr>
        </form>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script>
//Date picker
$('#datepicker').datepicker({
      autoclose: true
    })

//Red color scheme for iCheck
$('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })

    $(document).ready(function(){

        $(document).on('click','.btnadd',function(){

           var html = '';
           html+='<tr>';
           html+='<td><input type="hidden" class="form-control pname" name="productname[]" required readonly></td>';
           
           html+='<td><select class="form-control productid" name="productid[]"><option value="">Select Option</option></select></td>';
           
           html+='<td><input type="text" class="form-control stock" name="stock[]" readonly></td>';
           html+='<td><input type="text" class="form-control price" name="price[]" readonly></td>';
           html+='<td><input type="text" class="form-control quantity" name="quantity[]" ></td>';
           html+='<td><input type="text" class="form-control total" name="total[]" readonly></td>';
           html+='<td><center><button type="button" name="remove" class="btn btn-danger btn-sm btnremove"><span class="glyphicon glyphicon-remove"></span></button></center></td>';
           $('#tableProduct').append(html);
        })

        $(document).on('click','.btnremove',function(){

            $(this).closest('tr').remove();

        })

    })
</script>
 <?php

include_once 'footer.php';

?>