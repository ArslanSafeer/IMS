<?php
include('db.php');
?>

<?php


if(isset($_POST['d_btn'])){
$dd_id = $_POST['d_id'];

try{

 $sql = "DELETE from sold_child where child_id='$dd_id' ";
 $conn->exec($sql);
  
    echo '<script>  window.document.location="index.php?pg=pos"; </script>';

} catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage(); 
}

}

?>


<?php 

//echo $branch_id;

if(isset($_POST["o_btn"])){

$c_o ="INSERT INTO sold_head (entry_by,branch_id) values ('$Employee_id','$branch_id')";

$conn->exec($c_o);
    echo '<script> alert("Invoice no created successfully"); </script>';
    echo '<script>  window.document.location="index.php?pg=pos"; </script>';
}

$S_running ="SELECT invoice_no from sold_head where invoice_status=0";
$stmt = $conn->prepare($S_running);
$stmt->execute(); 
$mydata = $stmt->fetch();

$invoice_no = $mydata['invoice_no'];

if($invoice_no>0){

echo "Invoice Number: ".$invoice_no;
?>




<form id="from" name="form" method="post">

<br><br>


<table width="100%"> 
<tr>
  <td width="45%">
    <label>Select Item</label>
      <select class="form-control select2" multiple="multiple" name="item_id" id="item_id" data-placeholder="Select one" style="width: 100%;">
        
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
  
    <h1>Create Invoice</h1> <div style="position: fixed;right: 114px; top: 79px;  float:right;" > 

    <input type="submit"  name="o_btn" class="btn btn-success" value="Create Invoice" />

</form>

<?php }



if($invoice_no>0){
  ?>
<span id="show_invoice_detail"></span>


   
<?php } ?>


<?php

if(isset($_POST["final_btn"])){

$f_o ="UPDATE sold_head set invoice_status=1 where invoice_no='$invoice_no'";

$conn->exec($f_o);

    $invoice_no=$_POST['invoice_no']; 
    $amount=$_POST['chDiscount'];
    

$f_o_dic ="INSERT INTO discount (invoice_no,amount) VALUES ('$invoice_no','$amount')"; 
$conn->exec($f_o_dic);
    
   echo '<script> alert("Invoice Finalize Successfully"); </script>';
   echo '<script>  window.document.location="index.php?pg=pos"; </script>';


}

?>

</div>


<script>
 
  function insrt_d(){
 
    var item_id = $('#item_id').val();
    var product_qty = $('#product_qty').val();
    if(item_id!="" && product_qty!="" ){
      $.ajax({
        url: "insert_invoice_item.php",
        type: "POST",
        data: {
          item_id: item_id,
          product_qty: product_qty,
          invoice_no: '<?php echo $invoice_no; ?>' 
                  
        },success: function(dataResult){

          show_invoice_detail('<?php echo $invoice_no; ?>');       
           
          
        }
      });
    }
    else{
      alert('Please fill all the field !');
    }
  }

function show_invoice_detail(order){

    $.ajax({
       url: "select_record_item.php",
        type: "POST",
        data: {
          invoice_no:  order
                  
        },success: function(dataResult){
                   
          $('#show_invoice_detail').html(dataResult); 
          
        }
      });


}


$( document ).ready(function() {
show_invoice_detail('<?php echo $invoice_no; ?>'); 
});


</script>


