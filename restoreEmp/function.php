<?php
function get_total_all_records(){
	include('db.php');
	$statement = $connection->prepare("SELECT * FROM user WHERE is_deleted=1 ");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}
?>