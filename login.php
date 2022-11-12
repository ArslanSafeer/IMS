<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login From</title>
<link rel="stylesheet" href="dist/css/bootstrap.min.css">
<link rel="stylesheet" href="dist/css/font-awesome.min.css">
<script src="dist/js/jquery.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script> 
<style type="text/css">
	body {
		color: #fff;
		background: #76d4a9;
	}
	.form-control {
        min-height: 41px;
		background: #fff;
		box-shadow: none !important;
		border-color: #e3e3e3;
	}
	.form-control:focus {
		border-color: #70c5c0;
	}
    .form-control, .btn {        
        border-radius: 2px;
    }
	.login-form {
		width: 350px;
		margin: 0 auto;
		padding: 100px 0 30px;		
	}
	.login-form form {
		color: #7a7a7a;
		border-radius: 2px;
    	margin-bottom: 15px;
        font-size: 13px;
        background: #ececec;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;	
        position: relative;	
    }
	.login-form h2 {
		font-size: 22px;
        margin: 35px 0 25px;
    }
	.login-form .avatar {
		position: absolute;
		margin: 0 auto;
		left: 0;
		right: 0;
		top: -50px;
		width: 95px;
		height: 95px;
		border-radius: 50%;
		z-index: 9;
		background: #70c5c0;
		padding: 15px;
		box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
	}
	.login-form .avatar img {
		width: 100%;
		border-radius: 50%;
	}	
    .login-form input[type="checkbox"] {
        margin-top: 2px;
    }
    .login-form .btn {        
        font-size: 16px;
        font-weight: bold;
		background: #70c5c0;
		border: none;
		margin-bottom: 20px;
    }
	.login-form .btn:hover, .login-form .btn:focus {
		background: #50b8b3;
        outline: none !important;
	}    
	.login-form a {
		color: #fff;
		text-decoration: underline;
	}
	.login-form a:hover {
		text-decoration: none;
	}
	.login-form form a {
		color: #7a7a7a;
		text-decoration: none;
	}
	.login-form form a:hover {
		text-decoration: underline;
	}
</style>
</head>
<body>

<?php
include('db.php');
?>
<?php  
 
 try  
 {  
      if(isset($_POST["submit"]))  
      {  
           if(empty($_POST["username"]) || empty($_POST["password"]))  
           {  
                $message = '<label>All fields are required</label>';  
           }  
           else  
           {  

           	 $username = $_POST["username"]; 
             $password = $_POST["password"];
             $branch_id = $_POST["branch_id"]; 

 $query = "SELECT * FROM employee WHERE Employee_phone = '$username' AND Password = '$password' AND branch_id='$branch_id'"  ;  
$statement = $conn->prepare($query);  
$statement->execute();  
$mydata = $statement->fetch(); 
$count = $statement->rowCount();  
 
                if($count > 0)  
                {  
                     $_SESSION["Employee_id"] = $mydata["Employee_id"]; 
                     $_SESSION["Employee_name"] = $mydata["Employee_name"]; 
                     $_SESSION["Employee_phone"] = $mydata["Employee_phone"];
                     $_SESSION["branch_id"] = $mydata["branch_id"]; 
                     if(isset($_SESSION["Employee_id"])){
                     	header("location:index.php");  

                     }else{
                     	echo $message = '<label>Session not created.......</label>';  
                     }
                     
                }  
                else  
                {  
                     $message = '<label>Wrong Data</label>';  
                }  
           }  
      }  
 }  
 catch(PDOException $error)  
 {  
      $message = $error->getMessage();  
 }  
 ?>  

<div class="login-form">
    <form action="" method="post">
		<div class="avatar">
			<img src="\Ims\Image\img_avatar.png" alt="Avatar">
		</div>
        <h2 class="text-center">Member Login</h2>


<div class="form-group">
	
            <label for="">Select Branch</label>
    <select name="branch_id" class="form-control">
      <option value="">Select one</option>
      <?php
$s_emp = "SELECT branch_id, branch_name FROM branches";
$stmt = $conn->prepare($s_emp);
$stmt->execute(); 
$mydata = $stmt->fetchAll(); 
 
    foreach($mydata  as $k=> $v) {
        $branch_id1 = $v['branch_id'];
        $branch_name1 = $v['branch_name'];
      
  
?>

      <option value="<?php echo $branch_id1; ?>"><?php echo $branch_name1; ?></option>
<?php }?>
</select>
        
    </div>
        <div class="form-group">
        	<input type="text" class="form-control" name="username" value="<?php //echo @$_COOKIE['cid'];?>" placeholder="Username" required class="form-control">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="password" value="<?php //echo @$_COOKIE['cpass'];?>" placeholder="Password" required class="form-control">
        </div>

        <div class="clearfix">
            <tr>
            <th>Remember me</th>
            <td><input type="checkbox" name="ch"/></td>
        </tr>
        </div>
        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
        </div>
		
    </form>
</div>
</body>
</html>

<?php
@$id=$_POST['username'];       
@$pass=$_POST['password'];
if(isset($_POST['submit'])) 
{       
if($id=="03123456784" && $pass==123)      
{           
if($_POST['ch']==true)          
{           
setcookie("cid",$id,time()+60*60);          
setcookie("cpass",$pass,time()+60*60);          
header("location:index.php");           
}           
header("location:index.php");       
}       
else        
{       
echo "invalid id or pass";      
}   
}    
?>
















