<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script language="javascript">
function addInput(divName){
     
          var newdiv = document.createElement('div');
          newdiv.innerHTML = " <br><input type='text' name='phone[]'>";
          document.getElementById(divName).appendChild(newdiv);    
}
</script>
</head>
<body>
<?php
session_start();
$user=$_SESSION["myadmin"]; 
require_once("Config.php");
if($user==null)
{
	header("location:login.php");
}
else
{
?>

<form id="form1" name="form1" method="post" action="">
<?php echo "Welcome  <b>".$_SESSION["myadmin"]."</b>"; ?>
<p>

<label>
<input type="button" value="+" onClick="addInput('dynamicInput');">
<b>Add Phone</b>

<div id="dynamicInput">
          <input type="text" name="phone[]">
     </div>
</label>
</p>
<input type="submit" name="submit" value="submit">
<p><a href="logout.php">Click Here To Logout</a></p>
</form>
<?Php
//echo $_POST["phone"];
 require_once("Config.php");
	function getNextSequence($name)
	{
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
if(isset($_POST["submit"]))
{
		foreach($_POST['phone'] as $myarray) 
		{
		$user=$_SESSION["myadmin"];
		
	
		$result1 = $user_collection->update(array('name'=>$user),array('$push'=>array('phone'=>array('id'=>getNextSequence("userid"),'No'=>$myarray))));
		
		}
		 //echo $myarray.'<br>';
		if(!$result1)
		{
			die ('Not Updated');	
		}
		else
		{
			//echo $id;
			
			echo "<script language='javascript'>";
			echo "alert('Record Updated')";
			echo "</script>";
			//echo "Record Inserted";
		
	}
}
	$user=$_SESSION["myadmin"];
	$all = $user_collection->find(array("name"=>$user));
	
	echo "<table border=1>";
	echo "<tr><th>Contact No</th><th>Action</th></tr>";
	
	foreach($all as $row)
	{
		
  	 foreach($row['phone'] as $num=>$comment){
	 echo "<tr>";
      //echo $comment['id'];
	  echo "<td>";
	  echo $comment['No'].",";
	  echo "</td>";
	 	echo "<td><a href='edit.php?id=$comment[id]'>Edit</a>"." || ";
		echo "<a href='delete.php?id=$comment[id]'>Delete</a></td>";
	  echo "</tr>";
   }
}	
}?>

</body>
</html>