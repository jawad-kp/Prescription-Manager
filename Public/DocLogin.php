<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login as a Doctor</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width= device-width, initial-scale=1">
  	<style type="text/css">
  		.error{ color: red; font-size: 16px }
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
		$qry = "SELECT * FROM `Doclog` WHERE `DocID` LIKE \"$usr\"";
		// echo($qry);
		$res = $GLOBALS['conn']->query($qry);
		if($res->num_rows == 1)
		{
			$row = $res->fetch_assoc();
	    	$dbPass = $row["DocPass"];
	    	if(password_verify($pass, $dbPass))
	    	{
	    		$_SESSION["DocID"] = $usr;
	    		header("Location:PrescribeMedicine.php");
	    	}
	    	else
	    	{
	    		$GLOBALS["btmerr"] = "Incorrect User or Pass. Access Declined";
	    		return;
	    		
	    	}
		}

		// The section below is if a doctor has an account but is unapproved.
		$qry = "SELECT `DocID` FROM `PendingDoc` WHERE `DocID` LIKE \"$usr\"";
		$res = $GLOBALS['conn']->query($qry);
		if($res->num_rows == 1)
		{
			$GLOBALS["btmerr"] = "Account Pending Approval";
		}
		else
    	{
    		$GLOBALS["btmerr"] = "Incorrect User or Pass. Access Declined";
    		return;
    		
    	}
		

	}
  	
  ?>
  <div class="container">
        <center>
        <h1 style="color: black" class="fadeInDownBig animated">Sign in</h1></center><br>
        <div class="d-flex justify-content-center">
          <div class="whi">

            <form name="HenloFrens" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post" >
              <div class="row"></div>
              
                <div class="form-group">
            <input class="form-control" type="text" name="uid" placeholder="User ID" size="50">
            
            <div class="error"> <?php echo $uiderr;?> </div>
            </div>
            <br>
            <div class="form-group">
              
                 <input class="form-control" type="password" placeholder="Enter Password"  name="pass">
                  <div class="error"> <?php echo $pswderr;?> </div>   
               </div>
               <div class="error"> <?php echo $btmerr;?> </div> 
             <br>
              <center><button class="btn btn-primary hvr-grow" type="submit">Sign in</button></center>
             <br>
             
         </form>

      </div>
    </div>
</body>
</html>