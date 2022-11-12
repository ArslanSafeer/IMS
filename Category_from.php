

<?php

        $Category_Name = $_POST['category_name'];
        $Category_Description = $_POST['category_description'];


 if($_GET['edit']){
$edit_id  = $_GET['edit'];

$s_emp = "SELECT category_id, category_name, category_description FROM category where category_id='$edit_id' ";
$stmt = $conn->prepare($s_emp);
$stmt->execute(); 
$mydata = $stmt->fetch(); 
 
        $category_id1_e = $mydata['category_id'];
        $category_name1_e = $mydata['category_name'];
        $category_description1_e = $mydata['category_description'];
 }


if(isset($_POST['update'])){
 $update_id = $_POST['update_id'];
try{
 $s_emp = "UPDATE  category  set category_name='$Category_Name', category_description='$Category_Description' where category_id='$update_id' ";
    $conn->exec($s_emp); 
   echo '<script> alert("Data Updated  Successfully"); </script>';
   echo '<script>  window.document.location="index.php?pg=Category_from"; </script>';
}catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

        
 }



if(isset($_POST['submit'])){
$Category_Name = $_POST['category_name'];
$Category_Description = $_POST['category_description'];

try{
     $sql = "INSERT INTO category (category_name, category_description, branch_id)
    VALUES ('$Category_Name', '$Category_Description', '$branch_id')";
    $conn->exec($sql);
    echo '<script> alert("Data Insert  Successfully"); </script>';
    echo '<script>  window.document.location="index.php?pg=Category_from"; </script>';
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
}

if(isset($_POST['d_btn'])){
$dd_id = $_POST['d_id'];

try{


$sql = "UPDATE category SET deleted=1 where category_id='$dd_id' ";
 $conn->exec($sql);
  echo '<script> alert("Data Deleted  Successfully"); </script>';
    echo '<script>  window.document.location="index.php?pg=Category_from"; </script>';

} catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage(); 
}

}



?>

<form  method="Post">
  <div class="container">
    <h1>Category Registration</h1>
    <hr>

    <label >Category Name</label>
    <input type="text" name="category_name" placeholder="Category Name" value="<?php echo $category_name1_e; ?>" required class="form-control">

    <label>Category Description</label>
    <input type="text" name="category_description" placeholder="Category Description" value="<?php echo $category_description1_e; ?>" required class="form-control">

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
  <th style="border:1px solid black;">Category Id</th>
  <th style="border:1px solid black;">Category Name</th>
  <th style="border:1px solid black;">Category Description</th>
  <th style="border:1px solid black;">Option</th>
</tr>


<?php
$s_emp = "SELECT category_id, category_name, category_description FROM category where deleted=0";
$stmt = $conn->prepare($s_emp);
$stmt->execute(); 
$mydata = $stmt->fetchAll(); 
 
    foreach($mydata  as $k=> $v) {
        $category_id1 = $v['category_id'];
        $category_name1 = $v['category_name'];
        $category_description1 = $v['category_description'];
   
?>

<tr>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $category_id1; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $category_name1; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $category_description1; ?></td> 
<td style="border:1px solid black; background-color: #dddddd">
  
<form method="post" onsubmit="return confirm('Are you sure to delete category <?php echo $category_name1; ?>?');">
   <input type="hidden" name="d_id" value="<?php echo $category_id1; ?>"> 
   <input style="width:67px;" type="submit" class="btn btn-block bg-gradient-secondary btn-xs" name="d_btn" value="Delete">
</form>
<a style="width:67px;" class="btn btn-block bg-gradient-secondary btn-xs" href="?pg=Category_from&edit=<?php echo $category_id1; ?>">Edit</a>

</td>
</tr>
<?php } ?>

</table>

