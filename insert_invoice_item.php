
<?php
include('db.php');
	
	$Employee_id=$_SESSION["Employee_id"];
    $branch_id=$_SESSION["branch_id"];
	$product_qty=$_POST['product_qty'];
	$invoice_no=$_POST['invoice_no'];
	$item_id=$_POST['item_id'][0];

$current_rate_chk="SELECT  current_rate  from current_rates where item_id='$item_id'";
$current_rate_chk_rs = $conn->prepare($current_rate_chk);
$current_rate_chk_rs->execute(); 
$current_rate_chk_record = $current_rate_chk_rs->fetch();
$current_rate = $current_rate_chk_record['current_rate'];



if($item_id>0 && $product_qty>0 ){
  

$s_emp = "SELECT invoice_no FROM sold_child where  invoice_no='$invoice_no' and item_id='$item_id' ";
$stmt = $conn->prepare($s_emp);
$stmt->execute(); 
$mydata = $stmt->fetchAll();


  
if(count($mydata)>0){
 
try{
 $s_emp = "UPDATE  sold_child  set product_qty='$product_qty', invoice_no='$invoice_no' ,current_rate='$current_rate' where invoice_no='$invoice_no' and item_id='$item_id' ";
    $conn->exec($s_emp); 
     echo '<script> alert("Data Updated  Successfully"); </script>';
   echo '<script>  window.document.location="index.php?pg=pos"; </script>';
}catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }



}else{
$sql = "INSERT INTO sold_child (entry_by, product_qty,invoice_no,item_id, branch_id, current_rate) 
	VALUES ('$Employee_id', '$product_qty','$invoice_no','$item_id','$branch_id','$current_rate')";
 try{
    $conn->exec($sql);
     $msg = "Record Insert Successfully";
    }
catch(PDOException $e)
    {
    echo $msg . "<br>" . $e->getMessage();
    }

}


}else{
	///echo '<script> alert("Please enter the item code and qty properly."); </script>';
	 
}
echo $msg;

?>

