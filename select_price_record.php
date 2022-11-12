<?php

include('db.php');


$s_emp = "SELECT rate_id, current_rate,item_id,entry_by FROM current_rates";
$stmt = $conn->prepare($s_emp);
$stmt->execute(); 
$mydata1 = $stmt->fetchAll();

if(count($mydata1)==0){
echo "Data not found yet.";
}else{ 


?>



<br><br>

<div id="customers">
<table  width="100%" id="foo">
	
<tr>
	<th style="border:1px solid black;">Rate Id</th>
	<th style="border:1px solid black;">Item Id</th>
	<th style="border:1px solid black;">Current Rate</th>
	<th style="border:1px solid black;">Enter By</th>
	<th style="border:1px solid black;">Option</th>
	
  
	
    
</tr>

<?php

$sr=1;

 foreach($mydata1  as $k=> $mydata) {
		$rate_id1 = $mydata['rate_id'];
        $item_id1 = $mydata['item_id'];
        $current_rate1 = $mydata['current_rate'];
        $entry_by1 = $mydata['entry_by'];
        
        

?>

<tr>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $sr; ?></td>	
<td style="border:1px solid black; background-color: #dddddd"><?php echo $item_id1; ?></td> 
<td style="border:1px solid black; background-color: #dddddd"><?php echo $current_rate1; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $entry_by1; ?></td>
<td style="border:1px solid black; background-color: #dddddd"   class="no-print">

<form class="no-print" method="post" onsubmit="return confirm('Are you sure to delete Item Rate <?php echo $rate_id1; ?>?');">
   <input type="hidden" name="d_id" value="<?php echo $rate_id1; ?>"> 
   <input style="width:67px;" type="submit" class="btn btn-block bg-gradient-secondary btn-xs" name="d_btn" value="Delete">
</form>




</td>
</tr>


<?php $sr++;} ?>


</table>
</div>
<?php } ?>
