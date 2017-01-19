<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php
	require_once('Config.php');
 
function getNextSequence($name){
global $collection;
 
$retval = $collection->findAndModify(
     array('_id' => $name),
     array('$inc' => array("seq" => 1)),
     null,
     array(
        "new" => true,
		"upsert" => true
    )
);
return $retval['seq'];
}
	if(isset($_POST["signUp"]))
	{
		
		$name=$_POST["txtnm"];
		$add=$_POST["txtadd"];
		$cno=$_POST["txtcno"];
		$email=$_POST["txtemail"];
		$pwd=md5($_POST["txtpwd"]);
		$db_array=array('name' => $name,'address'=>$add,'phone'=>array(['id'=>getNextSequence("userid"),'No'=>$cno]),'email'=>$email,"password"=>$pwd);
 
		$ins = $user_collection->insert($db_array);
		echo "Record inserted...!";
		header("location:login.php");
	}
	if(isset($_POST["Login"]))
	{
		header("location:login.php");
	}
?>
<form name="frm1" method="post">
<table align="center">
<h3 align="center">Registration Form</h3>
<tr>
<td>Name</td>
<td><input type="text" name="txtnm" /></td>
</tr>
<tr>
<td>Address</td>
<td><input type="text" name="txtadd" /></td>
</tr>
<tr>
<td>phone</td>
<td><input type="text" name="txtcno" /></td>
</tr>
<tr>
<td>Email Id</td>
<td><input type="text" name="txtemail" /></td>
</tr>

<tr>
<td>Password</td>
<td><input type="password" name="txtpwd" /></td>
</tr>
<tr></tr>
<tr align="center">

<td colspan="2"><input type="submit" name="signUp" value="Sign Up" />
<input type="submit" name="Login" value="Back To Login" /></td>
</tr>
</table>
</form>
</body>
</html>
