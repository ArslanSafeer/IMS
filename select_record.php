

<?php

include('db.php');
$order_id=$_POST['order_id'];

$s_emp = "SELECT child_id, order_id,item_id,product_qty,Entry_by FROM order_child where order_id='$order_id'";
$stmt = $conn->prepare($s_emp);
$stmt->execute(); 
$mydata1 = $stmt->fetchAll();

if(count($mydata1)==0){
echo "Data not found yet.";
}else{ 


?>

<div style="float: right;">
<button class="btn btn-block bg-gradient-secondary btn-xs" type="button" value="Click Me" onclick="myFunction()">Print Report</button>

<script type="text/javascript">
 function myFunction(){
      var print_div = document.getElementById("customers");
var print_area = window.open();
print_area.document.write(print_div.innerHTML);
print_area.document.close();
print_area.focus();
print_area.print();
print_area.close();
// This is the code print a particular div element
    //window.print();
    }
</script>
</div>


<br><br>

<div id="customers">
<table  width="100%" id="foo">
	
<tr>
	<th style="border:1px solid black;">Child Id</th>
	<th style="border:1px solid black;">Order Id</th>
	<th style="border:1px solid black;">Item Id</th>
	<th style="border:1px solid black;">Product Quantity</th>
	<th style="border:1px solid black;">Entry By</th>
	<th style="border:1px solid black;" class="no-print">Option</th>
    
</tr>

<?php



 foreach($mydata1  as $k=> $mydata) {
		$Child_id1 = $mydata['child_id'];
        $Entry_by1 = $mydata['Entry_by'];
        $Product_qty1 = $mydata['product_qty'];
        $Order_id1 = $mydata['order_id'];
        $Item_id1 = $mydata['item_id'];
        

?>

<tr>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $Child_id1; ?></td>	
<td style="border:1px solid black; background-color: #dddddd"><?php echo $Order_id1; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $Item_id1; ?></td> 
<td style="border:1px solid black; background-color: #dddddd"><?php echo $Product_qty1; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $Entry_by1; ?></td> 
<td style="border:1px solid black; background-color: #dddddd"   class="no-print">
 
<form class="no-print" method="post" onsubmit="return confirm('Are you sure to delete order <?php echo $Child_id1; ?>?');">
   <input type="hidden" name="d_id" value="<?php echo $Child_id1; ?>"> 
   <input style="width:67px;" type="submit" class="btn btn-block bg-gradient-secondary btn-xs" name="d_btn" value="Delete">
</form>

</td>
</tr>


<?php } ?>


</table>
</div>
</br>
<center>
<form method='POST'>
      <button type="submit" name="final_btn" value="submit" class="btn btn-success">Finalize Order</button>
</form>
  </center>

<?php } ?>