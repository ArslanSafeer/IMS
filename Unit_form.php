
<?php
$Unit_Name = $_POST['unit_name'];
 $Unit_Description = $_POST['unit_description'];



 if($_GET['edit']){
 $edit_id  = $_GET['edit'];
$s_emp = "SELECT unit_id, unit_name, unit_description FROM unit where  unit_id='$edit_id' ";
$stmt = $conn->prepare($s_emp);
$stmt->execute(); 
$mydata = $stmt->fetch(); 
 
        $unit_id1_e = $mydata['unit_id'];
        $unit_name1_e = $mydata['unit_name'];
        $unit_description1_e = $mydata['unit_description'];
 }


if(isset($_POST['update'])){
 $update_id = $_POST['update_id'];
try{
 $s_emp = "UPDATE  unit  set unit_name='$Unit_Name', unit_description='$Unit_Description' where unit_id='$update_id' ";
    $conn->exec($s_emp); 
 	 echo '<script> alert("Data Updated  Successfully"); </script>';
   echo '<script>  window.document.location="index.php?pg=unit_form"; </script>';
}catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

        
 }


if(isset($_POST['submit'])){
$Unit_Name = $_POST['unit_name'];
$Unit_Description = $_POST['unit_description'];

try{
     $sql = "INSERT INTO unit (unit_name, unit_description,branch_id)
    VALUES ('$Unit_Name', '$Unit_Description', '$branch_id')";
    $conn->exec($sql);
    echo '<script> alert("Data Insert  Successfully"); </script>';
    echo '<script>  window.document.location="index.php?pg=unit_form"; </script>';
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
}


if(isset($_POST['d_btn'])){
$dd_id = $_POST['d_id'];

try{

$sql = "UPDATE unit SET deleted=1 where unit_id='$dd_id' ";
 $conn->exec($sql);
  echo '<script> alert("Data Deleted  Successfully"); </script>';
    echo '<script>  window.document.location="index.php?pg=unit_form"; </script>';

} catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage(); 
}

}



?>

<form method="Post">
  <div class="container">
    <h1>Unit Registration</h1>
    <hr>

    <label >Unit Name</label>
    <input type="text" name="unit_name" placeholder="Unit Name" value="<?php echo $unit_name1_e; ?>" required class="form-control">

    <label>Unit Description</label>
    <input type="text" name="unit_description" placeholder="Unit Description" value="<?php echo $unit_description1_e; ?>" required class="form-control">

    <hr>
  </div>
  
  <div class="container signin">

<?php

if($edit_id>0){ ?>
	<input type="hidden" name="update_id"  value="<?php echo $edit_id; ?>" >
 <button type="submit" name="update" value="Update" class="btn btn-info">Update</button>



<?php } else{ ?>

    <button type="submit" name="submit" value="submit" class="btn btn-success">Submit</button>
<?php }   ?>
  </div>

  
</form><br>
<table id="customers" width="100%">
  
<tr>
  <th style="border:1px solid black;">Unit Id</th>
  <th style="border:1px solid black;">Unit Name</th>
  <th style="border:1px solid black;">Unit Description</th>
  <th style="border:1px solid black;">Option</th>
</tr>


<?php
$s_emp = "SELECT unit_id, unit_name, unit_description FROM unit where deleted=0 ";
$stmt = $conn->prepare($s_emp);
$stmt->execute(); 
$mydata = $stmt->fetchAll(); 
 
    foreach($mydata  as $k=> $v) {
        $unit_id1 = $v['unit_id'];
        $unit_name1 = $v['unit_name'];
        $unit_description1 = $v['unit_description'];
   
?>

<tr>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $unit_id1; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $unit_name1; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $unit_description1; ?></td> 
<td style="border:1px solid black; background-color: #dddddd">
  
  <form method="post" onsubmit="return confirm('Are you sure to delete unit <?php echo $unit_name1; ?>?');">
   <input type="hidden" name="d_id" value="<?php echo $unit_id1; ?>"> 
   <input style="width:67px;" type="submit" class="btn btn-block bg-gradient-secondary btn-xs" name="d_btn" value="Delete">
</form>

<a style="width:67px;" class="btn btn-block bg-gradient-secondary btn-xs" href="?pg=unit_form&edit=<?php echo $unit_id1; ?>">Edit</a>

</td> 
</tr>
<?php } ?>

</table>
