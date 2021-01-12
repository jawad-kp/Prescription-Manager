<?php
session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login as Admin</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width= device-width, initial-scale=1">
  	<style type="text/css">
  		.error{ color: red; font-size: 16px }
		.titles {text-align: right;}
  	</style>
  	<link rel="stylesheet" type="text/css" href="../node_modules/bootstrap/dist/css/bootstrap.css">
  	<link rel="stylesheet" type="text/css" href="../Dependencies/Hover-master/css/hover.css">
  	<link rel="stylesheet" type="text/css" href="../Dependencies/CSS Animations/animate.css">
  	<script type="text/javascript" src="../node_modules/jquery/dist/jquery.js"></script>
  	<script type="text/javascript" src="../node_modules/bootstrap/dist/js/bootstrap.js">
	</script> 
</head>
<body>
	<?php

  	require "DBConfig.php";
  	require "InpModder.php";
  	$uiderr=$pswderr=$btmerr="";
  	$uid=$pswd="meow";
  	$boo= true;

  	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
	    if(empty($_POST["uid"])) 
	    {
	        $uiderr="* Please enter a valid User ID";
	        $boo = false;
	    }
	    else
	    {
	    	$uid=chngIP($_POST["uid"]);
	    }//UID

	    if(empty($_POST["pass"]))
	    {
	        $pswderr="* Please enter a Password";
	        $boo = false;
	    }
	    else
	    {
	    	$pswd=chngIP($_POST["pass"]);
	    }//password

	    if ($boo)
		{
			// header("Location: http://localhost:8080/DBMS/login.php");
			VeryifyVals($uid,$pswd);

		}


	}
	
	function VeryifyVals($usr,$pass)
	{
		$qry = "SELECT * FROM `adminlog` WHERE AdmId LIKE \"$usr\"";
		// echo($qry);
		$res = $GLOBALS['conn']->query($qry);
		if($res->num_rows == 1)
		{
			$row = $res->fetch_assoc();
	    	$dbPass = $row["AdmPass"];
	    	if(password_verify($pass, $dbPass))
	    	{
	    		$GLOBALS["btmerr"] = 'Correct Login!!<br> Welcome: '.$row['Name']; //Because we have a dictionary value here, we're forced to use concatination. It won't work with just " in the mix
	    		$_SESSION["AdminID"] = $usr;
	    		$_SESSION["Admin-Name"] = $row["Name"];

	    		header("Location:AdminDash.php");
	    	}
	    	else
	    	{
	    		$GLOBALS["btmerr"] = "Incorrect User or Pass. Access Declined";
	    		
	    	}
		}
		else
	    {
	    	$GLOBALS["btmerr"] = "User or pass is incorrect.";
	    }

	}
  	
  ?>
	<br>
	<div class="container-fluid">
		<center><h1 style="color: black" class="fadeInDownBig animated">Admin Sign in</h1></center><hr><br>
		<div class="container">
			<div class="row">
				<div class="col-3"></div>
					<form name="HenloFrens" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post" class="col-6">
						<div class="row form-group">
							<div class="col-4 titles">
								<label class = "#">User ID:</label>
							</div>
							<div class="col-6">
								<input class="form-control" type="text" name="uid" placeholder="User ID" size="50">
								<span class="error"> <?php echo $uiderr;?> </span>
							</div>
							<!-- <div class="error"> <?php echo $uiderr;?> </div> -->
						</div>
						<br>
						<div class="row form-group">
							<div class="col-4 titles">
								<label class = "#">Password:</label>
							</div>
							<div class="col-6">
								<input class="form-control" type="password" placeholder="Enter Password"  name="pass">
								<span class="error"> <?php echo $pswderr;?> </span>   
							</div>
						</div>
					<!-- <div class="error"> <?php echo $btmerr;?> </div>  -->
						<br>
						<center><button class="btn btn-primary hvr-glow" type="submit">Sign in</button></center>
					</form>
				<div class="col-3">
			</div>
		</div>
	</div>
</body>
</html>