<script type="text/javascript">
    function get_order(v){

 window.document.location="index.php?pg=receive_order&o_id="+v;

    }

</script>

<?php 

$o_id = $_GET['o_id'];

 
if (isset($_POST['order_btn'])) {
	
        
        for ($i = 0; $i <= count($_POST['item_code']); $i++)  
        {  

        $item_code = $_POST['item_code'][$i]; 
        $receive_item = $_POST['receive_item'][$i];   
        $purchase_amount = $_POST['purchase_amount'][$i];   
  if($receive_item > 0){
 $sql = "UPDATE  order_child set received_qty='$receive_item' , purchase_amount='$purchase_amount' where item_id='$item_code' and order_id='$o_id' ";
	      $conn->exec($sql);

  }
	
	       }
	       echo '<script> alert("Received."); </script>';

}
?>

<table width="100%"> 
<tr>
  <td>
    <label for="">Select Order</label>
    <select name="order_id" id="order_id" onchange="get_order(this.value)" class="form-control select2" >
      <option value="">Select one</option>
<?php
$s_emp = "SELECT order_id,order_date,order_by,order_status from order_head where order_status=1";
$stmt = $conn->prepare($s_emp);
$stmt->execute(); 
$mydata = $stmt->fetchAll(); 
 
    foreach($mydata  as $k=> $v) {
        $order_id1 = $v['order_id'];
        $order_date1 = $v['order_date'];
        $order_by1 = $v['order_by'];
        $order_status1 = $v['order_status'];
  
?>

      <option value="<?php echo $order_id1; ?>" <?php if($o_id ==  $order_id1 ){ echo 'selected';} ?>  ><?php echo $order_id1; ?></option>
<?php }?>


    </select>
 
</td>
</tr>
</table>
<br>

<form method='POST'>
<table id="customers" width="100%">
    
<tr>
    <th style="border:1px solid black;">Item Id</th>
    <th style="border:1px solid black;">Product Quantity</th>
    <th style="border:1px solid black;">Receive Quantity</th>
    <th style="border:1px solid black;">Item Price</th>
    <th style="border:1px solid black;">Total Amount</th>
    <th style="border:1px solid black;">Enter Quantity</th>
    <th style="border:1px solid black;">Price Par Piece</th>



</tr>

<?php
 $amt_tot =0;
$s_emp = "SELECT a.item_id, product_qty, received_qty,purchase_amount , item_name
FROM order_child a
JOIN items b on a.item_id=b.Item_id where  order_id='$o_id'";
$stmt = $conn->prepare($s_emp);
$stmt->execute(); 
$mydata = $stmt->fetchAll(); 
 
    foreach($mydata  as $k=> $v) {
        $item_id1 = $v['item_id'];
        $product_qty1 = $v['product_qty'];
        $received_qty1 = $v['received_qty'];
        $purchase_amount1 = $v['purchase_amount'];
        $item_name = $v['item_name'];

$amt = 0;

$amt = $received_qty1*$purchase_amount1;

    $amt_tot += $amt;    

?>

<tr>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $item_id1." | ".$item_name; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $product_qty1; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $received_qty1; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $purchase_amount1; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $amt; ?></td>

<td style="border:1px solid black; background-color: #dddddd">

    <input type="text" id="" name="receive_item[]" value="<?php echo $received_qty1; ?>">
    <input type="hidden" id="" name="item_code[]" value="<?php echo $item_id1; ?>">
</td>
<td style="border:1px solid black; background-color: #dddddd">
  
  <input type="text" id="" name="purchase_amount[]" value="<?php echo $purchase_amount1; ?>">

</td>

</td> 
</tr>
<?php } ?>
<tr>
	<td><b><u>Total Amount:</u></b></td>
	<td></td>
	<td></td>
	<td> </td>
	<td><b><?php echo  $amt_tot; ?></b></td>
	<td></td>
	<td></td>

</tr>
</table>
<br>
<center>

      <button type="submit" name="order_btn" value="submit" class="btn btn-success">Receive Order</button>
</form>
</center>


	





