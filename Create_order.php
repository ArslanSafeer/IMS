  <div class="container">


<?php


if(isset($_POST['d_btn'])){
$dd_id = $_POST['d_id'];

try{

$sql = "DELETE from order_child where child_id='$dd_id' ";
 $conn->exec($sql);
  
    echo '<script>  window.document.location="index.php?pg=Create_order"; </script>';

} catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage(); 
}

}

?>



<?php 

//echo $branch_id;

if(isset($_POST["o_btn"])){

$c_o ="INSERT INTO order_head (order_by) values ('$Employee_id')";

$conn->exec($c_o);
    echo '<script> alert("Order Created Successfully"); </script>';
    echo '<script>  window.document.location="index.php?pg=Create_order"; </script>';
}

$S_running ="SELECT order_id from order_head where order_status=0";
$stmt = $conn->prepare($S_running);
$stmt->execute(); 
$mydata = $stmt->fetch();

$order_id = $mydata['order_id'];

if($order_id>0){

echo "Order Number: ".$order_id;
?>
 

<form id="from" name="form" method="post">

<br><br>
 
<table width="100%"> 
<tr>
  <td width="45%">
     
    <label for="">Select Product</label>
    <select name="item_id" id="item_id" class="form-control select2" >
      <option value="">Select one</option>
<?php
$s_emp = "SELECT item_id, item_name, item_weight,item_color FROM items where deleted=0";
$stmt = $conn->prepare($s_emp);
$stmt->execute(); 
$mydata = $stmt->fetchAll(); 
 
    foreach($mydata  as $k=> $v) {
        $unit_id1 = $v['item_id'];
        $unit_name1 = $v['item_name'];
        $unit_description1 = $v['item_weight'];
        $unit_description1 = $v['item_color'];
  
?>

      <option value="<?php echo $unit_id1; ?>"><?php echo $unit_id1." | ".$unit_name1; ?></option>
<?php }?>

    </select>
 
</td>
<td width="45%">
    <label>Product Quantity</label>
    <input type="text" name="product_qty" id="product_qty"   placeholder="Product Quantity" required class="form-control"> 
</td>
<td><br><label></label><br>
    
    <button style="    padding: 6px;" type="button" onclick="insrt_d();" value="submit" id="submit" class="btn btn-success" >Insert Item</button>
  
</td>
</tr>
</table>

    <hr>
</form>

<?php  }else{ ?>
<form method="Post" >
  
    <h1>Create Order</h1> <div style="position: fixed;right: 114px; top: 79px;  float:right;" > 

    <input type="submit"  name="o_btn" class="btn btn-success" value="Create Order" />

</form>

 <?php }



if($order_id>0){
  ?>

<span id="show_order_detail"></span>


   
<?php } ?>


<?php

if(isset($_POST["final_btn"])){

$f_o ="UPDATE order_head set order_status=1 where order_id='$order_id'";

$conn->exec($f_o);
    echo '<script> alert("Order Finalize Successfully"); </script>';
    echo '<script>  window.document.location="index.php?pg=Create_order"; </script>';
}

?>
 </div>




<script>
 
  function insrt_d(){
 
    var item_id = $('#item_id').val();
    var product_qty = $('#product_qty').val();
    
    if(item_id!="" && product_qty!="" ){
      $.ajax({
        url: "insert_order_item.php",
        type: "POST",
        data: {
          item_id: item_id,
          product_qty: product_qty,
          order_id: '<?php echo $order_id; ?>' 
                  
        },success: function(dataResult){
           show_order_detail('<?php echo $order_id; ?>');       
           
          
        }
      });
    }
    else{
      alert('Please fill all the field !');
    }
  }

function show_order_detail(order){

    $.ajax({
       url: "select_record.php",
        type: "POST",
        data: {
          order_id:  order
                  
        },success: function(dataResult){
                   
          $('#show_order_detail').html(dataResult); 
          
        }
      });




}


$( document ).ready(function() {
show_order_detail('<?php echo $order_id; ?>'); 
});


</script>





