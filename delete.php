<?php
	session_start();
	
	require_once("Config.php");
	$user=$_SESSION["myadmin"];
	$id=(int)$_GET["id"];
	echo $user;
	echo $id;
	//$array=array('_id'=>new MongoId($id));
	
	$r=$user_collection->update(array('name'=>$user),array('$pull'=>array('phone'=>array('id'=>$id))));
	
	if(!$r)
	{
		die('Not Delete');
	}
	else
	{
	//echo "deleted";
		header('location:home.php');
	}
?>