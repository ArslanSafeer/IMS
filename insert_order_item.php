
<?php
include('db.php');
	
	$Employee_id=$_SESSION["Employee_id"];
    $branch_id=$_SESSION["branch_id"];
	$product_qty=$_POST['product_qty'];
	$order_id=$_POST['order_id'];
	$item_id=$_POST['item_id'];



if($item_id>0 && $product_qty>0){


$s_emp = "SELECT item_id FROM order_child where  order_id='$order_id' and item_id='$item_id' ";
$stmt = $conn->prepare($s_emp);
$stmt->execute(); 
$mydata = $stmt->fetchAll(); 
  
if(count($mydata)>0){
 
try{
 $s_emp = "UPDATE  order_child  set product_qty='$product_qty' where order_id='$order_id' and item_id='$item_id' ";
    $conn->exec($s_emp); 
 	 echo '<script> alert("Data Updated  Successfully"); </script>';
   echo '<script>  window.document.location="index.php?pg=Create_order"; </script>';
}catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }



}else{
 $sql = "INSERT INTO order_child (Entry_by, product_qty,order_id,item_id, branch_id) 
	VALUES ('$Employee_id', '$product_qty','$order_id','$item_id','$branch_id')";
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

