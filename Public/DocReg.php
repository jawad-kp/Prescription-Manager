
<!DOCTYPE html>
<html>
<head>
	<title>Regsiter as a Doctor</title>
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
	$nmerr=$uiderr=$pswderr=$reperr=$addrerr=$Moberr="";
	$nm=$uid=$pswd=$RePass=$Addr=$Mob="junk";

	$boo= true; //this is our flag to make sure registration is legit
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		if(empty($_POST["uid"]))
	    {
	        $uiderr="Please enter a valid User ID";
	        $boo = false;
	    }
	    else
	    {
	    	$uid=chngIP($_POST["uid"]);
	    }//UID


	     if(empty($_POST["nm"]))
	    {
	        $nmerr="Please enter a valid Name";
	        $boo = false;
	    }
	    else
	    {
	    	$nm=chngIP($_POST["nm"]);
	    }//name


	    if(empty($_POST["pass"]))
	    {
	        $pswderr="Please enter a valid Name";
	        $boo = false;
	    }
	    else
	    {
	    	$pswd=chngIP($_POST["pass"]);
	    }//Password

	    if(empty($_POST["RePass"]))
	    {
	        $reperr="Please enter a valid Name";
	        $boo = false;
	    }
	    else
	    {
	    	$RePass=chngIP($_POST["RePass"]);
	    }//Repeat Password

	    if ($boo && $pswd != "" && $RePass != "") 
	    {
	    	if (strcmp($pswd, $RePass) !== 0) 
	    	{
	    		$boo = false;
	    		$reperr= "Passwords Do Not match";
	    	}
	    	
	    }// Passwords don't match

	    if(empty($_POST["Addr"]))
	    {
	    	$addrerr = "This field is mandatory";
	    	$boo = false;
	    }
	    else
	    {
	    	$Addr = chngIP($_POST["Addr"]);
	    }
	    if(empty($_POST["Contact"]))
	    {
	    	$Moberr = "This field is mandatory";
	    	$boo = false;
	    }
	    else
	    {
	    	$Mob = chngIP($_POST["Contact"]);
	    }

	    send_data($boo,$uid,$nm,$pswd,$Addr,$Mob);
	}

    function send_data($bleh,$usr,$name,$pass,$adr,$phn)
        { 
        	// echo "Entered send_data with value: $bleh <br> User ID $usr <br>Name: $name<br>Pass: $pass <br>"; //debug.
	    	if($bleh)
	    	{
		    	$qry = "INSERT INTO `pendingdoc` (`DocID`, `DocName`, `DocPass`, `DocAddr`, `Contact`) VALUES (?, ?, ?, ?, ?)";

		    	$prepStmt = $GLOBALS['conn']->prepare($qry);//This works simliar to the Java thingy where we create a prepared statement.
		   
		    	//First we check if username already exists
		    	$chkQu = "SELECT `DocID` FROM `pendingdoc` WHERE `DocID` LIKE \"$usr\" ";
		    	$res1 = $GLOBALS['conn']->query($chkQu);
		    	//echo "Exectued first Check<br>";
		    	$chkQu = "SELECT `DocID` FROM `doclog` WHERE `DocID` LIKE \"$usr\" ";
		    	$res2 = $GLOBALS['conn']->query($chkQu);

		    	if (($res1->num_rows == 0) && ($res2->num_rows == 0))
		    	{
		    		$pass = password_hash($pass, PASSWORD_DEFAULT); //I encrypt the passwords here so they're not plain text but are hashes instead. This basically gives us additional security
		    		$prepStmt->bind_param("sssss",$usr,$name,$pass,$adr,$phn);
		    		// echo "Statement prepared<br>";
		    		$prepStmt->execute();
		    		// echo "Account Created Successfully";
		    		// Add link to somewhere telling account has been created and a hyper-link to go back.
		    	}//User id is not in use
		    	else
		    	{
		    		$GLOBALS['uiderr'] = "User ID is in use";
		    	}
		    	$GLOBALS['conn']->close();
			}

    	}//send_data

?>

	<div class="container-fluid">
	<form name="docreg" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
		<div class="row form-group">

	 		<div class="col-sm-4">
				<label class = "lab">Name </label>
			</div>
			
			<div class="col-sm-6">
				<input type="text" name="nm" placeholder="Your name..." class="form-control">
				<span class="error">* <?php echo $nmerr;?></span>
			</div>	
		
		</div>

		<div class="row form-group">

			<div class="col-sm-4">
				<label class = "lab">User ID</label>
			</div>

			<div class="col-sm-6">
				<input type="text" name="uid" placeholder="User ID" class="form-control">
				<span class="error">*  <?php echo $uiderr;?> </span>
			</div>	

		</div>

		<div class="row form-group">

			<div class="col-sm-4">
				<label class = "lab">Password</label>
			</div>

			<div class="col-sm-6">
		           <input type="password" placeholder="Enter Password" name="pass" class="form-control" required>
		           <span class="error">* <?php echo $pswderr;?> </span>	
		    </div>

		</div>

		<div class="row form-group">
			<div class="col-sm-4">
		         <label class = "lab">Re-enter Password</label>
            </div>

            <div class="col-sm-6">
		           <input type="password" placeholder="Renter Password" name="RePass" class="form-control" autocomplete="new-password">
		           <span class="error">* <?php echo $reperr;?> </span>

		    </div>	
        </div>

        <div class="row form-group">

			<div class="col-sm-4">
		         <label class = "lab">Address</label>
            </div>

            <div class="col-sm-6">
		           <input type="textbox" placeholder="Enter Address" name="Addr" class="form-control">
		           <span class="error">* <?php echo $addrerr;?> </span>
		    </div>

        </div>

        <div class="row form-group">

			<div class="col-sm-4">
		         <label class = "lab">Contact Number</label>
            </div>

            <div class="col-sm-6">
		           <input type="text" placeholder="Mob/Work Number" name="Contact" pattern="^[1-9]{1}[0-9]{9}$" class="form-control">
		           <span class="error">* <?php echo $Moberr;?> </span>
		    </div>
		    	
        </div>

        <div class="row">
        	<div class="col-sm"></div>
        	<div class="col-sm">
	        	<button type="submit" class=" btn btn-primary hvr-radial-out " style="background-color: black; font-size: 25px; border: none;">Submit</button>	
     		</div>
        	<div class="col-sm"></div>

     	</div>	

		
	</form>
</div>

</body>
</html>