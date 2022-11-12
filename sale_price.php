
<?php


if(isset($_POST['d_btn'])){
$dd_id = $_POST['d_id'];

try{

$sql = "DELETE from current_rates where rate_id='$dd_id' ";
 $conn->exec($sql);
  
    echo '<script>  window.document.location="index.php?pg=sale_price"; </script>';

} catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage(); 
}

}

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
    <label>Enter Rate</label>
    <input type="text" name="current_rate" id="current_rate"   placeholder="Enter Rate" required class="form-control"> 
</td>
<td><br><label></label><br>
    
   <button style="    padding: 6px;" type="button" onclick="insrt_d();" value="submit" id="submit" class="btn btn-success" >Insert Item</button>
  
</td>
</tr>
</table>

    <hr>
</form>


<span id="show_order_detail"></span>



<script>
 
  function insrt_d(){
 
    var item_id = $('#item_id').val();
    var current_rate = $('#current_rate').val();
    if(item_id!="" && current_rate!="" ){
      $.ajax({
        url: "insert_item_price.php",
        type: "POST",
        data: {
          item_id: item_id,
          current_rate: current_rate,
          rate_id: '<?php echo $rate_id; ?>' 
                  
        },success: function(dataResult){

          show_order_detail();       
           
          
        }
      });
    }
    else{
      alert('Please fill all the field !');
    }
  }

function show_order_detail(){

    $.ajax({
       url: "select_price_record.php",
        type: "POST",
        data: {
          action:  1
                  
        },success: function(dataResult){
                   
          $('#show_order_detail').html(dataResult); 
          
        }
      });

}


$( document ).ready(function() {
show_order_detail('<?php echo $rate_id; ?>'); 
});


</script>
