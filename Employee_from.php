<?php
                    // Include config file
                    require_once "db.php";
                    ?>
<?php

$Employee_Name = $_POST['Employee_name'];
$Employee_Designation = $_POST['Employee_designation'];
$Employee_DOB = $_POST['Employee_dob'];
$Phone_No = $_POST['Employee_phone'];
$Password = $_POST['Password'];


if($_GET['edit']){
 $edit_id  = $_GET['edit'];

 $s_emp = "SELECT Employee_id, Employee_name, Employee_designation,Employee_dob,Employee_phone FROM employee where Employee_id='$edit_id' ";
$stmt = $conn->prepare($s_emp);
$stmt->execute(); 
$mydata = $stmt->fetch(); 

        $Employee_id1_e = $mydata['Employee_id'];
        $Employee_name1_e = $mydata['Employee_name'];
        $Employee_designation1_e = $mydata['Employee_designation'];
        $Employee_dob1_e = $mydata['Employee_dob'];
        $Employee_phone1_e = $mydata['Employee_phone'];

 }


if(isset($_POST['update'])){
 $update_id = $_POST['update_id'];
try{
 $s_emp = "UPDATE  employee  set Employee_name='$Employee_Name', Employee_designation='$Employee_Designation', Employee_dob='$Employee_DOB', Employee_phone='$Phone_No', Password='$Password' where Employee_id='$update_id' ";
    $conn->exec($s_emp); 
   echo '<script> alert("Data Updated  Successfully"); </script>';
   echo '<script>  window.document.location="index.php?pg=emp_reg"; </script>';
}catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

 }



if(isset($_POST['submit'])){
$Employee_Name = $_POST['Employee_name'];
$Employee_Designation = $_POST['Employee_designation'];
$Employee_DOB = $_POST['Employee_dob'];
$Phone_No = $_POST['Employee_phone'];
$Password = $_POST['Password'];

try{
     $sql = "INSERT INTO employee (Employee_name, Employee_designation, Employee_dob,Employee_phone,Password,branch_id)
    VALUES ('$Employee_Name', '$Employee_Designation', '$Employee_DOB','$Phone_No','$Password','$branch_id')";
    $conn->exec($sql);
    echo '<script> alert("Data Insert  Successfully"); </script>';
    echo '<script>  window.document.location="index.php?pg=emp_reg"; </script>';
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
}

if(isset($_POST['d_btn'])){
$dd_id = $_POST['d_id'];

try{


$sql = "UPDATE employee SET deleted=1 where Employee_id='$dd_id' ";
 $conn->exec($sql);
  echo '<script> alert("Data Deleted  Successfully"); </script>';
    echo '<script>  window.document.location="index.php?pg=emp_reg"; </script>';

} catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage(); 
}

}



?>

<form method="Post" >
  <div class="container">
    <h1>Employee Registration</h1>
    <p>Please fill in this form to Create an Account.</p>
    <hr>

    <label >Employee Name</label>
    <input type="text" name="Employee_name" placeholder="Employee Name" value="<?php echo $Employee_name1_e; ?>"  required class="form-control">

    <label>Employee Designation</label>
    <input type="text" name="Employee_designation" placeholder="Employee Designation" value="<?php echo $Employee_designation1_e; ?>" required class="form-control">

    <label>Employee Date of Birth</label>
    <input type="Date" name="Employee_dob" placeholder="Employee Date of Birth" value="<?php echo $Employee_dob1_e ; ?>" required class="form-control">

    <label>Phone Number</label>
    <input type="text" name="Employee_phone"  placeholder="Phone Number" value="<?php echo $Employee_phone1_e ; ?>" required class="form-control">

    <label>Password</label>
    <input type="password" name="Password" placeholder="Password" required class="form-control">

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
	<th style="border:1px solid black;">Employee Id</th>
	<th style="border:1px solid black;">Employee Name</th>
	<th style="border:1px solid black;">Employee Designation</th>
	<th style="border:1px solid black;">Employee Dob</th>
	<th style="border:1px solid black;">Employee Number</th>
    <th style="border:1px solid black;">Option</th>
</tr>

<?php
$s_emp = "SELECT Employee_id, Employee_name, Employee_designation,Employee_dob,Employee_phone FROM employee where deleted=0 ";
$stmt = $conn->prepare($s_emp);
$stmt->execute(); 
$mydata = $stmt->fetchAll(); 
 
    foreach($mydata  as $k=> $v) {
        $Employee_id1 = $v['Employee_id'];
        $Employee_name1 = $v['Employee_name'];
        $Employee_designation1 = $v['Employee_designation'];
        $Employee_dob1 = $v['Employee_dob'];
        $Employee_phone1 = $v['Employee_phone'];
?>

<tr>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $Employee_id1; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $Employee_name1; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $Employee_designation1; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $Employee_dob1; ?></td> 
<td style="border:1px solid black; background-color: #dddddd"><?php echo $Employee_phone1; ?></td> 
<td style="border:1px solid black; background-color: #dddddd">

<form method="post" onsubmit="return confirm('Are you delete Mr/Mis: <?php echo $Employee_name1; ?>?');">
   <input type="hidden" name="d_id" value="<?php echo $Employee_id1; ?>"> 
   <input type="submit" class="btn btn-block bg-gradient-secondary btn-xs" name="d_btn" value="Delete">
</form>

<a class="btn btn-block bg-gradient-secondary btn-xs" href="?pg=emp_reg&edit=<?php echo $Employee_id1;?>">Edit</a>

</td> 
</tr>
<?php } ?>

</table>


 
