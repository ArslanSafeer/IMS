<center>
<h1>Total Invoice Sale</h1>
</center><br>
<h1 style="text-align: center;">Select Date From-To</h1>
<center>
<form method=post>
<label>From:</label>
<input type="date" id="myDate" name="from_date" value="" >
<label>To:</label>
<input type="date" id="myDate" name="to_date" value="">
<input type="submit" value="submit" id="submit"/>
</form>
</center>
<?php

include('db.php');
 $date = $_GET['date'];
$from_date  = $_POST['from_date'];
 $to_date  = $_POST['to_date'];
 

if(empty($date)){

$s_emp = "SELECT DATE_FORMAT(a.entry_date,'%d-%m-%Y') as entry_date , invoice_no, sum(product_qty*current_rate) as amount,
(SELECT amount FROM discount WHERE DATE_FORMAT(entry_date,'%d-%m-%Y')  = DATE_FORMAT(a.entry_date,'%d-%m-%Y') and invoice_no=a.invoice_no) as dic_amount
FROM sold_child a
where  
DATE_FORMAT(a.entry_date,'%d-%m-%Y')>= DATE_FORMAT('$from_date','%d-%m-%Y') and  
DATE_FORMAT(a.entry_date,'%d-%m-%Y')<= DATE_FORMAT('$to_date','%d-%m-%Y') 
GROUP BY DATE_FORMAT(a.entry_date,'%D %M %Y'),invoice_no";
}else{
$s_emp = "SELECT DATE_FORMAT(a.entry_date,'%d-%m-%Y') as entry_date , invoice_no, sum(product_qty*current_rate) as amount,
(SELECT amount FROM discount WHERE DATE_FORMAT(entry_date,'%d-%m-%Y')  = DATE_FORMAT(a.entry_date,'%d-%m-%Y') and invoice_no=a.invoice_no) as dic_amount
FROM sold_child a
where  
DATE_FORMAT(a.entry_date,'%d-%m-%Y') =  '$date'   
GROUP BY DATE_FORMAT(a.entry_date,'%d-%m-%Y'),invoice_no";



}
 $s_emp ;
$stmt = $conn->prepare($s_emp);
$stmt->execute(); 
$mydata1 = $stmt->fetchAll();

if(count($mydata1)==0){
echo "Data not found.";
}else{ 


?>

<div style="float: right; margin-right: 12px;">
<button class="btn btn-block bg-gradient-secondary btn-xs" type="button" value="Click Me" onclick="myprint()">Print Report</button>

<script type="text/javascript">
 function myprint(){
      var print_div = document.getElementById("customers");
var print_area = window.open();
print_area.document.write(print_div.innerHTML);
print_area.document.close();
print_area.focus();
print_area.print();
print_area.close();

    }
</script>
</div>

<br><br>
<center>
<div id="customers">
<table  width="80%" id="foo">
	
<tr>
    <th style="border:1px solid black;">Date</th>
	<th style="border:1px solid black;">Invoice No</th>
	<th style="border:1px solid black;">Amount</th>
	<th style="border:1px solid black;">Discount</th>
	<th style="border:1px solid black;">Net Amount</th>
	
</tr>

<?php

$amt_tot =0;

 foreach($mydata1  as $k=> $mydata) {

		 
		$entry_date = $mydata['entry_date'];
		$invoice_no = $mydata['invoice_no'];
        $amount = $mydata['amount'];
        $dic_amount = $mydata['dic_amount'];
        $net_amount=$amount-$dic_amount;

$amt = 0;

$amt = $amount-$dic_amount;

    $amt_tot += $amt;


?>

<tr>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $entry_date; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $invoice_no; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $amount; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $dic_amount; ?></td> 
<td style="border:1px solid black; background-color: #dddddd"><a href="?pg=total_item_invoice&date=<?php echo $entry_date; ?>" ><?php echo $net_amount; ?></a></td> 
 
</tr>


<?php } ?>
<tr>
	<td><b><u>Total Amount</u></b></td>
	<td></td>
	<td></td>
	<td><b></b></td>
	<td><b><?php echo  $amt_tot; ?></b></td>
	

</tr>


</table>
</div>
</center>
<?php }  ?>




