<?php  
  include('db.php');
   $from_date  = $_POST['from_date'];
 $to_date  = $_POST['to_date'];

  
$s_emp = "SELECT DATE_FORMAT(a.entry_date,'%d-%m-%Y')entry_date , sum(product_qty*current_rate) as total_sale ,
(SELECT SUM(amount) FROM discount WHERE DATE_FORMAT(entry_date,'%D %M %Y')  = DATE_FORMAT(a.entry_date,'%D %M %Y')) as dic_amount
FROM sold_child a
where DATE_FORMAT(a.entry_date,'%d-%m-%Y')>= DATE_FORMAT('$from_date','%d-%m-%Y') and  
DATE_FORMAT(a.entry_date,'%d-%m-%Y')<= DATE_FORMAT('$to_date','%d-%m-%Y') 
GROUP BY DATE_FORMAT(a.entry_date,'%Y %M %D')";
$stmt = $conn->prepare($s_emp);
$stmt->execute(); 
$mydata1 = $stmt->fetchAll();

if(count($mydata1)==0){
echo "Data not found.";}
else{ 


?>


<br><br>

<center>
<div id="customers">
<table  width="80%" id="foo">
	
<tr>
    <th style="border:1px solid black;">Date</th>
	<th style="border:1px solid black;">Amount</th>
	<th style="border:1px solid black;">Discount</th>
	<th style="border:1px solid black;">Net Amount</th>
	
</tr>

<?php

$amt_tot =0;

 foreach($mydata1  as $k=> $mydata) {

		$entry_date1 = $mydata['entry_date'];
        $dic_amount1 = $mydata['dic_amount'];
        $total_sale1 = $mydata['total_sale'];
        $net_amount1=$total_sale1-$dic_amount1;


$amt = 0;

$amt = $total_sale1-$dic_amount1;

    $amt_tot += $amt; 


?>

<tr>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $entry_date1; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $total_sale1; ?></td> 
<td style="border:1px solid black; background-color: #dddddd"><?php echo $dic_amount1; ?></td> 
<td style="border:1px solid black; background-color: #dddddd"><a href="?pg=total_invoice_day&date=<?php echo $entry_date1; ?>"><?php echo $net_amount1; ?></a></td>

</tr>


<?php } ?>
<tr>
	<td><b><u>Total Amount:</u></b></td>
	<td></td>
	<td></td>
	<td><b><?php echo  $amt_tot; ?></b></td>
	

</tr>


</table>
</div>
</center>
<?php }  ?> 

