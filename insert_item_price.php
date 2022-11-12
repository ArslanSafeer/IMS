<?php
include('db.php');
	
	$branch_id=$_SESSION["branch_id"];
    $Employee_id=$_SESSION["Employee_id"];
	$current_rate=$_POST['current_rate'];
    $rate_id=$_POST['rate_id'];
	$item_id=$_POST['item_id'][0];



if($item_id>0 && $current_rate>0){

$s_emp = "SELECT item_id FROM current_rates where item_id='$item_id' ";
$stmt = $conn->prepare($s_emp);
$stmt->execute(); 
$mydata = $stmt->fetchAll();



if(count($mydata)>0){
 
try{
 $s_emp = "UPDATE  current_rates  set current_rate='$current_rate' where  item_id='$item_id' ";
    $conn->exec($s_emp); 
     echo '<script> alert("Data Updated  Successfully"); </script>';
   echo '<script>  window.document.location="index.php?pg=sale_price"; </script>';
}catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }



}else{
$sql = "INSERT INTO current_rates (entry_by, current_rate,item_id, branch_id) 
	VALUES ('$Employee_id','$current_rate','$item_id','$branch_id')";
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