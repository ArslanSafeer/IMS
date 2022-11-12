

<?php

$Item_Name = $_POST['item_name'];
$Item_Weight = $_POST['item_weight'];
$Item_Color = $_POST['item_color'];



 if($_GET['edit']){
$edit_id  = $_GET['edit'];

$s_emp = "SELECT item_id, item_name, item_weight,item_color FROM items where  item_id='$edit_id' ";
$stmt = $conn->prepare($s_emp);
$stmt->execute(); 
$mydata = $stmt->fetch(); 
 
        $item_id1_e = $mydata['item_id'];
        $item_name1_e = $mydata['item_name'];
        $item_weight1_e = $mydata['item_weight'];
        $item_color1_e = $mydata['item_color'];
 }


if(isset($_POST['update'])){
 $update_id = $_POST['update_id'];
try{
 $s_emp = "UPDATE  items  set Item_name='$Item_Name', Item_Weight='$Item_Weight', Item_Color='$Item_Color' where item_id='$update_id' ";
    $conn->exec($s_emp); 
   echo '<script> alert("Data Updated  Successfully"); </script>';
   echo '<script>  window.document.location="index.php?pg=Item_form"; </script>';
}catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

        
 }


if(isset($_POST['submit'])){
$Item_Name = $_POST['item_name'];
$Item_Weight = $_POST['item_weight'];
$Item_Color = $_POST['item_color'];
$unit_id = $_POST['unit_id'];
$category_id = $_POST['category_id'];

try{
     $sql = "INSERT INTO items (item_name, item_weight,item_color,unit_id,category_id, branch_id)
    VALUES ('$Item_Name', '$Item_Weight','$Item_Color','$unit_id','$category_id', '$branch_id')";
    $conn->exec($sql);
    echo '<script> alert("Data Insert  Successfully"); </script>';
    echo '<script>  window.document.location="index.php?pg=Item_form"; </script>';
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
}

if(isset($_POST['d_btn'])){
$dd_id = $_POST['d_id'];

try{


$sql = "UPDATE items SET deleted=1 where Item_id='$dd_id' ";
 $conn->exec($sql);
  echo '<script> alert("Data Deleted  Successfully"); </script>';
    echo '<script>  window.document.location="index.php?pg=Item_form"; </script>';

} catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage(); 
}

}

?>

<form method="Post">
  <div class="container">
    <h1>Item Registration</h1>
    <hr>

    <label >Item Name</label>
    <input type="text" name="item_name" placeholder="Item Name" value="<?php echo $item_name1_e; ?>" required class="form-control">

    <label>Item Weigth</label>
    <input type="text" name="item_weight" placeholder="Item Weigth" value="<?php echo $item_weight1_e; ?>" required class="form-control">

    <label>Item Color (Optional)</label>
    <input type="text" name="item_color" placeholder="Item Color" value="<?php echo $item_color1_e; ?>" class="form-control"> <br>

<label for="">Select Unit</label>
    <select name="unit_id" class="form-control">
     <option value="">--Choose--</option>
<?php

$s_emp = "SELECT unit_id, unit_name, unit_description FROM unit where deleted=0";
$stmt = $conn->prepare($s_emp);
$stmt->execute(); 
$mydata = $stmt->fetchAll(); 
 
    foreach($mydata  as $k=> $v) {
         $unit_id1 = $v['unit_id'];
        $unit_name1 = $v['unit_name'];
        $unit_description1 = $v['unit_description'];
  
?>

      <option value="<?php echo $unit_id1; ?>"><?php echo $unit_name1; ?></option>
<?php }?>    
    </select>



<label for=""> Select Category</label>
    <select name="category_id" class="form-control">
      <option value="">--Choose--</option>

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

      <option value="<?php echo $category_id1; ?>"><?php echo $category_name1; ?></option>
<?php }?>    
    </select>





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



</form><br><br>
<table id="customers" width="100%">
  
<tr>
  <th style="border:1px solid black;">Item Id</th>
  <th style="border:1px solid black;">Item Name</th>
  <th style="border:1px solid black;">Item Weight</th>
  <th style="border:1px solid black;">Item Color</th>
  <th style="border:1px solid black;">Option</th>
</tr>


<?php
$s_emp = "SELECT item_id, item_name, item_weight,item_color FROM items where deleted=0";
$stmt = $conn->prepare($s_emp);
$stmt->execute(); 
$mydata = $stmt->fetchAll(); 
 
    foreach($mydata  as $k=> $v) {
        $item_id1 = $v['item_id'];
        $item_name1 = $v['item_name'];
        $item_weight1 = $v['item_weight'];
        $item_color1 = $v['item_color'];
   
?>

<tr>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $item_id1; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $item_name1; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $item_weight1; ?></td>
<td style="border:1px solid black; background-color: #dddddd"><?php echo $item_color1; ?></td> 
<td style="border:1px solid black; background-color: #dddddd">
  

  <form method="post" onsubmit="return confirm('Are you sure to delete item <?php echo $item_name1; ?>?');">
   <input type="hidden" name="d_id" value="<?php echo $item_id1; ?>"> 
   <input style="width:67px;" type="submit" class="btn btn-block bg-gradient-secondary btn-xs" name="d_btn" value="Delete">
</form>
<a style="width:67px;" class="btn btn-block bg-gradient-secondary btn-xs" href="?pg=Item_form&edit=<?php echo $item_id1; ?>">Edit</a>

</td> 
</tr>
<?php } ?>

</table>

