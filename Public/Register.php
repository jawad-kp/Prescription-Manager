<!DOCTYPE html>
<html>
<head>
	<title>User Registration</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width= device-width, initial-scale=1">
  	<style type="text/css">
  		.error{ color: red; font-size: 16px }
		.titles {text-align: right;}
  	</style>
  	<link rel="stylesheet" type="text/css" href="../node_modules/bootstrap/dist/css/bootstrap.css">
  	<link rel="stylesheet" type="text/css" href="../Dependencies/Hover-master/css/hover.css">
<!-- We need to minify this one (MDI), and customise it with just what we need  -->
  	<link rel="stylesheet" type="text/css" href="../node_modules/@mdi/font/css/materialdesignicons.min.css">
  	<link rel="stylesheet" type="text/css" href="../node_modules/pretty-checkbox/dist/pretty-checkbox.css">
  	<script type="text/javascript" src="../node_modules/jquery/dist/jquery.js"></script>
  	<script type="text/javascript" src="../node_modules/bootstrap/dist/js/bootstrap.js">
	</script> 
</head>
<body>
	<?php

	require "DBConfig.php";
	require "InpModder.php";
	require __DIR__."/../EncrypterCustom.php";
	$nmerr=$uiderr=$pswderr=$reperr=$Addrerr=$Doberr="";
	$nm=$uid=$pswd=$RePass=$Addr=$Gend=$Dob="junk";

	$boo= true;
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		$Gend = $_POST["gender"];
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
	        $pswderr="Please enter a valid Password";
	        $boo = false;
	    }
	    else
	    {
	    	$pswd=chngIP($_POST["pass"]);
	    }//Password

	    if(empty($_POST["RePass"]))
	    {
	        $reperr="Please enter a valid Password";
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
	    	$Addrerr = "This field is mandatory";
	    	$boo = false;
	    }
	    else
	    {
	    	$Addr = chngIP($_POST["Addr"]);
	    }
	    if(empty($_POST["DOB"]))
	    {
	    	$Doberr = "Please fill in your Date of Birth";
	    	$boo = false;
	    }
	    else
	    {
	    	$Dob = chngIP($_POST["DOB"]);
	    }

	    send_data($boo,$uid,$nm,$pswd,$Addr,$Dob,$Gend);
	}

    function send_data($bleh,$usr,$name,$pass,$adr,$DtOB,$Gen)
        { 
        	// echo "Entered send_data with value: $bleh <br> User ID $usr <br>Name: $name<br>Pass: $pass <br>"; //debug.
	    	if($bleh)
	    	{
		    	$qry = "INSERT INTO `patlog`(`PatID`, `PatName`, `PatPass`, `Addr`, `PatDOB`, `PatGen`) VALUES (?,?,?,?,?,?)";

		    	$prepStmt = $GLOBALS['conn']->prepare($qry);//This works simliar to the Java thingy where we create a prepared statement.
		   
		    	//First we check if username already exists
		    	$chkQu = "SELECT `PatID` FROM `patlog` WHERE `PatID` LIKE \"$usr\" ";
		    	$res = $GLOBALS['conn']->query($chkQu);

		    	if ($res->num_rows == 0)
		    	{
		    		$pass = password_hash($pass, PASSWORD_DEFAULT); //Encrypt Password 
		    		$name = Encrptr($name);
		    		$adr = Encrptr($adr);
		    		$prepStmt->bind_param("ssssss",$usr,$name,$pass,$adr,$DtOB,$Gen);
		    		$prepStmt->execute();
		    		echo "Account Created Successfully";
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
	<center><h1 style="color: black" class="fadeInDownBig animated">User Register</h1></center><hr><br>
		<div class="row">
			<div class="col-2"></div>
			<form name="docreg" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="col-8">
				<div class="row form-group">

	 				<div class="col-sm-4 titles">
						<label class = "lab">Name: </label>
					</div>
			
					<div class="col-sm-6">
						<input type="text" name="nm" placeholder="Your name..." class="form-control">
						<span class="error"> <?php echo $nmerr;?></span>
					</div>	
				</div>
				<br>
				<div class="row form-group">

					<div class="col-sm-4 titles">
						<label class = "lab">User ID: </label>
					</div>

					<div class="col-sm-6">
						<input type="text" name="uid" placeholder="User ID" class="form-control">
						<span class="error">  <?php echo $uiderr;?> </span>
					</div>	

				</div>
				<br>
				<div class="row form-group">

					<div class="col-sm-4 titles">
						<label class = "lab">Password: </label>
					</div>

					<div class="col-sm-6">
						<input type="password" placeholder="Enter Password" name="pass" class="form-control" required>
						<span class="error"> <?php echo $pswderr;?> </span>	
					</div>

				</div>
				<br>
				<div class="row form-group">
					<div class="col-sm-4 titles">
						<label class = "lab">Re-enter Password: </label>
					</div>

					<div class="col-sm-6">
						<input type="password" placeholder="Renter Password" name="RePass" class="form-control" autocomplete="new-password">
						<span class="error"> <?php echo $reperr;?> </span>

					</div>	
				</div>
				<br>

				<div class="row form-group">

					<div class="col-sm-4 titles">
						<label class = "lab">Address: </label>
					</div>

					<div class="col-sm-6">
						<textarea class="form-control" rows="3" id="Addr" name="Addr"></textarea>
						<span class="error"> <?php echo $Addrerr;?> </span>
					</div>
						
				</div>
				<br>
				<div class="row form-group">

					<div class="col-sm-4 titles">
						<label for="DOB" class = "lab">DOB: </label>
					</div>

					<div class="col-sm-6">
						<input type="date" placeholder="DOB" name="DOB"class="form-control">
						<span class="error"> <?php echo $Doberr;?> </span>
					</div>
						
				</div>
				<br>
				<div class="row form-group">

					<div class="col-sm-4 titles">
						<label for="DOB" class = "lab">Gender: </label>
					</div>
					<div class="col-sm-6">
						<select name="gender" class="form-control" >
							<option value="" disabled selected>Select your gender</option>
							<option value="Cis-Male">Cis-Male</option>
							<option value="Cis-Female">Cis-Female</option>
							<option value="Trans-Male">Trans-Male</option>
							<option value="Trans-Female">Trans-Female</option>
							<option value="Non-Binary">Non-Binary</option>
							<option value="Decline">Decline</option>
						</select>
					</div>
				</div>
				<br>
				<center><button type="submit" class=" btn btn-primary hvr-glow ">Submit</button></center>
		
			</form>
			<div class="col-2"></div>
		</div>
	</div>

<!-- <div class="row">

	<div class="col-sm-8">
		<div class="pretty p-icon p-curve p-jelly">
			<input type="radio" name="gender" value="Cis-Male">
			<div class="state p-info">
				<i class="icon mdi mdi-check"></i>
				<label> Cis-Male</label>
			</div>
		</div>


		<div class="pretty p-icon p-curve p-jelly">
			<input type="radio" name="gender" value="Cis-Female">
			<div class="state p-info">
				<i class="icon mdi mdi-check"></i>
				<label> Cis-Female</label>
			</div>
		</div>

		<div class="pretty p-icon p-curve p-jelly">
			<input type="radio" name="gender" value="Trans-Male">
			<div class="state p-info">
				<i class="icon mdi mdi-check"></i>
				<label> Trans-Male</label>
			</div>
		</div>

		<div class="pretty p-icon p-curve p-jelly">
			<input type="radio" name="gender" value="Trans-Female">
			<div class="state p-info">
				<i class="icon mdi mdi-check"></i>
				<label> Trans-Female</label>
			</div>
		</div>

		<div class="pretty p-icon p-curve p-jelly">
			<input type="radio" name="gender" value="Non-Binary">
			<div class="state p-info">
				<i class="icon mdi mdi-check"></i>
				<label> Non-Binary</label>
			</div>
		</div>

		<div class="pretty p-icon p-curve p-jelly">
			<input type="radio" name="gender" checked="checked" value="Decline">
			<div class="state p-info">
				<i class="icon mdi mdi-check"></i>
				<label> Decline</label>
			</div>
		</div>
	</div>

		
</div> -->

<!-- <div class="row">
	<div class="col-sm"></div>
	<div class="col-sm">
		<button type="submit" class=" btn btn-primary hvr-glow ">Submit</button>	
	</div>
	<div class="col-sm"></div>

</div>	 -->
		

</body>
</html>