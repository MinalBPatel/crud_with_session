<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edit</title>
</head>

<body>
<?php
	session_start();
	
	require_once("Config.php");
	$user=$_SESSION["myadmin"];
	$id=(int)$_GET["id"];
	
	$all = $user_collection->find(array("name"=>$user));
	echo "<form name='frm1' method='post'>";
	echo "<table>";
	//echo "<tr><th>userid</th><th>Student Name</th><th>Student Address</th><th>Phone</th><th>Action</th></tr>";
	
	foreach($all as $row)
	{
		echo "<tr>";
		 foreach($row['phone'] as $num=>$comment)
		 {
		 	if($comment['id']==$id)
			{
      		echo"<td><input type='text' name='txtp' value=".$comment['No']."></td>";
			}
		   }
   		echo "</td>";
   		echo "</tr>";
		echo"<td><input type='submit' name='submit' value='submit'></td>";
		echo "</tr>";
	}
	echo "</table>";
	echo "</form>";
	if(isset($_POST["submit"]))
	{
	$no=$_POST["txtp"];
	//$r=$user_collection->update(array('phone'=>(array('No'=>$id))),array('$set'=>array('phone'=>array('No'=>$no))),false,true);
	$r=$user_collection->update(array('phone.id'=>$id),array('$set'=>array('phone.$.No'=>$no)));
	if(!$r)
	{
		die('Not updated');
	}
	else
	{
	//echo "deleted";
		header('location:home.php');
	}
	}
?>
</body>
</html>
