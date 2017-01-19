<?php
	$m = new MongoClient();
 
$db = $m->session;
$collection = $db->counters;
$user_collection = $db->reg;	
?>