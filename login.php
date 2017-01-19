<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php
if(isset($_POST["Login"]))
{
	session_start();
			require_once("config.php");
			if(isset($_POST['txtemail']) && (md5($_POST['txtpwd'])))
			{
				$username=$_POST["txtemail"];
				$password=md5($_POST["txtpwd"]);
				$all = $user_collection->find();
			
				foreach($all as $row)
				{
					if($row["email"]==$_POST["txtemail"] && $row["password"]==md5($_POST["txtpwd"]))
					{
					$_SESSION["myadmin"]=$row["name"];
					echo $_SESSION["myadmin"];
					header("location:home.php");
					}
			   }
				//echo "welcome";
				
				
			}
}
if(isset($_POST["SignUp"]))
{
	header("location:reg.php");
}
?>
<form name="frm1" method="post">
<table align="center">
<h3 align="center">Login </h3>
<tr>
<td>Email Id</td>
<td><input type="text" name="txtemail" /></td>
</tr>

<tr>
<td>Password</td>
<td><input type="password" name="txtpwd" /></td>
</tr>
<tr align="center">
<td colspan="2"><input type="submit" name="Login" value="Log in" />
<input type="submit" name="SignUp" value="Sign Up" /></td>
</tr>
</table>
</form>
</body>
</html>
