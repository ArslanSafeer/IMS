

<?php

$Supplier_Name = $_POST['Supplier_name'];
$Supplier_Phoneno = $_POST['Supplier_phoneno'];
$Supplier_Address = $_POST['Supplier_address'];
$Supplier_NTN = $_POST['Supplier_ntn'];
$Supplier_CNIC = $_POST['Supplier_cnic'];
$Payee_NO = $_POST['Payee_no'];
$Account_NO = $_POST['Account_no'];



if($_GET['edit']){
$edit_id  = $_GET['edit'];

$s_emp = "SELECT Supplier_id, Supplier_name, Supplier_Phoneno,Supplier_address,Supplier_ntn,Supplier_cnic,Payee_no,Account_no FROM supplierlist where Supplier_id='$edit_id' ";
$stmt = $conn->prepare($s_emp);
$stmt->execute(); 
$mydata = $stmt->fetch(); 
 
         $Supplier_id1_e = $mydata['Supplier_id'];
        $Supplier_name1_e = $mydata['Supplier_name'];
        $Supplier_Phoneno1_e = $mydata['Supplier_Phoneno'];
        $Supplier_address1_e = $mydata['Supplier_address'];
        $Supplier_ntn1_e = $mydata['Supplier_ntn'];
        $Payee_no1_e = $mydata['Payee_no'];
        $Account_no1_e = $mydata['Account_no'];
        $Supplier_cnic1_e = $mydata['Supplier_cnic'];
 }


if(isset($_POST['update'])){
 $update_id = $_POST['update_id'];
try{
  $s_emp = "UPDATE  supplierlist  set Supplier_name='$Supplier_Name', Supplier_phoneno='$Supplier_Phoneno', Supplier_address='$Supplier_Address', Supplier_ntn='$Supplier_NTN' , Supplier_cnic='$Supplier_CNIC', Payee_no='$Payee_NO', Account_no='$Account_NO' where Supplier_id='$update_id'";
    $conn->exec($s_emp); 
   echo '<script> alert("Data Updated  Successfully"); </script>';
   echo '<script>  window.document.location="index.php?pg=Supplier_form"; </script>';
}catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

        
 }


if(isset($_POST['submit'])){


try{
     $sql = "INSERT INTO supplierlist (Supplier_name, Supplier_phoneno, Supplier_address,Supplier_ntn,Supplier_cnic,Payee_no,Account_no,branch_id)
    VALUES ('$Supplier_Name', '$Supplier_Phoneno', '$Supplier_Address','$Supplier_NTN','$Supplier_CNIC','$Payee_NO','$Account_NO','$branch_id')";
    $conn->exec($sql);
    echo '<script> alert("Data Insert  Successfully"); </script>';
    echo '<script>  window.document.location="index.php?pg=Supplier_form"; </script>';
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
}

if(isset($_POST['d_btn'])){
$dd_id = $_POST['d_id'];

try{


$sql = "UPDATE supplierlist SET deleted=1 where Supplier_id='$dd_id' ";
 $conn->exec($sql);
  echo '<script> alert("Data Deleted  Successfully"); </script>';
    echo '<script>  window.document.location="index.php?pg=Supplier_form"; </script>';

} catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage(); 
}

}


?>

<form method="Post">
  <div class="container">
    <h1>Supplier Registration</h1>
    <hr>

    <label >Supplier Name (Company Name)</label>
    <input type="text" name="Supplier_name" placeholder="Supplier Name" value="<?php echo $Supplier_name1_e; ?>" required class="form-control">

    <label>Phone Number</label>
    <input type="text" name="Supplier_phoneno" placeholder="Supplier Number" value="<?php echo $Supplier_Phoneno1_e; ?>" required class="form-control">

    <label>Supplier Address</label>
    <input type="text" name="Supplier_address" placeholder="Supplier Address" value="<?php echo $Supplier_address1_e; ?>" required class="form-control">

    <label>Supplier NTN No</label>
    <input type="text" name="Supplier_ntn" placeholder="Supplier NTN No" value="<?php echo $Supplier_ntn1_e; ?>" required class="form-control">

    <label >Payee Name</label>
    <input type="text" name="Payee_no" placeholder="Payee Name" value="<?php echo $Payee_no1_e; ?>" required class="form-control">

    <label >Bank Account No</label>
    <input type="text" name="Account_no" placeholder="Account Number" value="<?php echo $Account_no1_e; ?>" required class="form-control">

    <label>Supplier CNIC</label>
    <input type="text" name="Supplier_cnic" placeholder="Supplier CNIC" value="<?php echo $Supplier_cnic1_e; ?>" required class="form-control">


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
</form><br><br>
<table id="customers" width="100%">
    
<tr>
    <th style="border:1px solid black;">Supplier Id</th>
    <th style="border:1px solid black;">Supplier Name</th>
    <th style="border:1px solid black;">Supplier Number</th>
    <th style="border:1px solid black;">Supplier Address</th>
    <th style="border:1px solid black;">Supplier NTN</th>
    <th style="border:1px solid black;">Payee Number</th>
    <th style="border:1px solid black;">Bank Account No</th>
    <th style="border:1px solid black;">Supplier CNIC</th>
    <th style="border:1px solid black;">Option</th>
</tr>


<?php
$s_emp = "SELECT Supplier_id, Supplier_name, Supplier_Phoneno,Supplier_address,Supplier_ntn,Supplier_cnic,Payee_no,Account_no FROM supplierlist where deleted=0";
$stmt = $conn->prepare($s_emp);
$stmt->execute(); 
$mydata = $stmt->fetchAll(); 
 
    foreach($mydata  as $k=> $v) {
        $Supplier_id1 = $v['Supplier_id'];
        $Supplier_name1 = $v['Supplier_name'];
        $Supplier_Phoneno1 = $v['Supplier_Phoneno'];
        $Supplier_address1 = $v['Supplier_address'];
        $Supplier_ntn1 = $v['Supplier_ntn'];
        $Payee_NO1 = $v['Payee_no'];
        $Account_NO1 = $v['Account_no'];
        $Supplier_cnic1 = $v['Supplier_cnic'];
?>

<tr>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $Supplier_id1; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $Supplier_name1; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $Supplier_Phoneno1; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $Supplier_address1; ?></td> 
<td style="border:1px solid black; background-color: #dddddd"><?php echo $Supplier_ntn1; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $Payee_NO1; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $Account_NO1; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $Supplier_cnic1; ?></td> 
<td style="border:1px solid black; background-color: #dddddd">
    
<form method="post" onsubmit="return confirm('Are you sure to delete supplier <?php echo $Supplier_name1; ?>?');">
   <input type="hidden" name="d_id" value="<?php echo $Supplier_id1; ?>"> 
   <input style="width:67px;" type="submit" class="btn btn-block bg-gradient-secondary btn-xs" name="d_btn" value="Delete">
</form>
<a style="width:67px;" class="btn btn-block bg-gradient-secondary btn-xs" href="?pg=Supplier_form&edit=<?php echo $Supplier_id1; ?>">Edit</a>

</td> 
</tr>
<?php } ?>

</table>

 