
<?php

 include('header.php');
 include('side_menu.php');
 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
 <?php 
 
if(empty($_SESSION["Employee_id"])){
 header("location:login.php");  
echo '<script>  window.document.location="login.php";  </script>';
}

$pg = $_GET['pg'];


switch ($pg) {
    case 'emp_reg':  include('Employee_from.php');break;
    case 'unit_form':  include('unit_form.php');break;
    case 'Category_from':  include('Category_from.php');break;
    case 'Supplier_form':  include('Supplier_form.php');break;
    case 'Item_form':  include('Item_form.php');break;
    case 'Create_order':  include('Create_order.php');break;
    case 'receive_order':  include('receive_order.php');break;
    case 'pos':  include('pos.php');break;
    case 'sale_price':  include('sale_price.php');break;
    case 'sales_report':  include('sales_report.php');break;
    case 'total_invoice_day':  include('total_invoice_day.php');break;
    case 'total_item_invoice':  include('total_item_invoice.php');break;
    case 'reset_pass':  include('reset_pass.php');break;
    
   
    default:
    include('dashboard.php');
        
}



  ?>
 
     <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include('footer.php'); ?>
