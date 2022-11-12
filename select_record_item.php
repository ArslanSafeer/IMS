
<?php

include('db.php');
$invoice_no=$_POST['invoice_no'];

$s_emp = "SELECT a.child_id, b.current_rate, invoice_no,a.item_id,product_qty,a.Entry_by 
FROM sold_child a 
JOIN current_rates b on a.item_id=b.item_id where invoice_no='$invoice_no'";
$stmt = $conn->prepare($s_emp);
$stmt->execute(); 
$mydata1 = $stmt->fetchAll();

if(count($mydata1)==0){
echo "Data not found yet.";
}else{ 


?>



<br><br>

<div id="customers">
<table  width="70%" id="foo">
	
<tr>

	<th style="border:1px solid black;">Child Id</th>
	<th style="border:1px solid black;">Invoice No</th>
	<th style="border:1px solid black;">Item Id</th>
	<th style="border:1px solid black;">Current Rate</th>
	<th style="border:1px solid black;">Product Quantity</th>	
	<th style="border:1px solid black;">Total Price</th>	
	<th style="border:1px solid black;">Option</th>	
	
	
  
	
    
</tr>



<?php

$sr=1;
$amt_tot =0;

 foreach($mydata1  as $k=> $mydata) {
		$Child_id1 = $mydata['child_id'];
		$invoice_no1 = $mydata['invoice_no'];
        $item_id1 = $mydata['item_id'];
        $product_qty1 = $mydata['product_qty'];
        $current_rate1 = $mydata['current_rate'];
        
        $amt = 0;

$amt = $product_qty1*$current_rate1;

    $amt_tot += $amt;

?>

<tr>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $sr; ?></td>	
<td style="border:1px solid black; background-color: #dddddd"><?php echo $invoice_no; ?></td>	
<td style="border:1px solid black; background-color: #dddddd"><?php echo $item_id1; ?></td>
 <td style="border:1px solid black; background-color: #dddddd"><?php echo $current_rate1; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $product_qty1; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $amt; ?></td>
<td style="border:1px solid black; background-color: #dddddd"   class="no-print">

<form class="no-print" method="post" onsubmit="return confirm('Are you sure to delete Item <?php echo $Child_id1; ?>?');">
   <input type="hidden" name="d_id" value="<?php echo $Child_id1; ?>"> 
   <input style="width:67px;" type="submit" class="btn btn-block bg-gradient-secondary btn-xs" name="d_btn" value="Delete">
</form>


</td>
</tr>



<?Php $sr++ ?>
<?php } ?>


<tr>
	<td><b><u>Total Amount:</u></b></td>
	<td></td>
	<td></td>
	<td> </td>
	<td> </td>
	<td><b><?php echo  $amt_tot; ?></b></td>
	<td></td>
	<td></td>

</tr>

</table>

<br>

<form method='POST'>
	<input type="hidden" id="invoice_no" name="invoice_no" value="<?php echo $invoice_no; ?>">
	<table>
		<tr>
<th><label>Invoice Amount:</label></th>
<td><input readonly id="cBalance" name="cBalance" value="<?php echo $amt_tot; ?>"></td>
</tr>
<tr>
<th><label>Discount%:</label></th>
<td><input id="chDiscount" name="chDiscount" type="text" onkeyup="disc();"><span id="per"></span></td>
</tr>
<tr>
<th><label>Receiveable Amount:</label></th>
<td><input readonly id="result" name="result" type="text"></td>
</tr>
</table>


 
<center>

      <button type="submit" name="final_btn" value="submit" class="btn btn-success">Finalize Invoice</button>

  </center>
</form>
</div>
<?php } ?>

<script>
        function disc(){
            var main = Number($('#cBalance').val());
            var disc = Number($('#chDiscount').val());
          
 var perc = (disc*100)/main;

if(perc>5){
	alert('Discount allowed till 5%');
$('#result').val('');
$('#per').html('');
}else{
	var discont = main - disc;
    $('#result').val(discont);
    $('#per').html(perc.toFixed(2)+'%');
}

}

    </script>
    

