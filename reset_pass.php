<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
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
session_start();
$Employee_id = $_SESSION["Employee_id"];
 
//user is logged in
if ($_POST['submit'])
{
        $oldpassword = $_POST['oldpassword'];
        $newpassword= $_POST['newpassword'];
        $repeatnewpassword = $_POST['repeatnewpassword'];
    $s_emp = "SELECT Password FROM employee WHERE Employee_id ='$Employee_id'  and password='$oldpassword'";
   $stmt = $conn->prepare($s_emp);
   $stmt->execute(); 
  $mydata1 = $stmt->fetchAll(); 
    echo $mydata1."<br>";
   if (count($mydata1)==1)
   {
    if ($newpassword==$repeatnewpassword)
       {
       $querychange1 = "UPDATE employee SET Password='$newpassword' WHERE Employee_id='$Employee_id'";
         $stmt1 = $conn->prepare($querychange1);
   $stmt1->execute();
       die("Your password has been changed");
      }
        else {
      die (" new passwords don't match!");
       
   }
   
   
      }
      }
       
?> 

<div class="login-form">
    <form action="" method="post">
		<div class="avatar">
			<img src="\Ims\Image\img_avatar.png" alt="Avatar">
		</div>
        <h2 class="text-center">Member Login</h2>


        <div class="form-group">
            <input type="Password" name="oldpassword" placeholder="Old Password" required class="form-control">
        </div>

        <div class="form-group">
        	<input type="Password"  name="newpassword" placeholder="New-Password" required class="form-control">
        </div>
		<div class="form-group">
            <input type="password" name="repeatnewpassword" placeholder="Retype-Password" required class="form-control">
        </div>
        <div class="form-group">
            <input  type="submit" name="submit" class="btn btn-primary btn-lg btn-block"  value="Reset Password"  />
        </div>
    </form>
</div>
</body>
</html>


















