<?php


function print_p($v) {
	echo "<pre>",print_r($v),"</pre>";
}


function get_file($s) {
	$file = file_get_contents($s);
	return json_decode($file);
}


function dbConnect() {
	$db_host = "shuminchang50.com";
	$db_user = "shuminch_wnm608";
	$db_pass ="S208h3556ko!";
	$db_name = "shuminch_wnm608";

	$conn = new mysqli(
		// conn doesn't exsit outside of the function
		$db_host,
		$db_user,
		$db_pass,
		$db_name

	);

if($conn->connect_errno)
	die ($conn->connect_error);
// this function is to return connection to the data

return $conn;

}
function getQueryResults($conn,$sql) {

	$result = $conn->query($sql);

	if($conn->errno)
		die(json_encode([
			"sql"=>$sql,
			"error"=>$conn->error
		]));

	$result_array = [];

	while($row = $result->fetch_object()) {
		$result_array[] = $row;
	}

	return $result_array;
}


function areset($a) {
	foreach($a as $o) {
		if(!isset($_GET[$o])) return false;
	}
	return true;
}

function getDefault($p,$s,$d) {
	return areset($p) ?
		vsprintf(
			$s,
			array_map(
				function($a){ return $_GET[$a]; },
				$p
			)
		) :
		$d;
}
function likeGroup($where,$like) {
	$result = " WHERE ";
	$arr = explode(",",$where);
	foreach($arr as $i=>$o) {
		if($i) $result .= " OR ";
		$result .= " $o LIKE '%$like%' ";
	}
	return $result;
}

