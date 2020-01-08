<?php
require_once"../lib/php/helpers.php";
$conn = dbConnect();

// call different item that you created
// type ?where=category&what=love to the url 
// http://www.shuminchang50.com/aau/wnm608/m12/demo/data/data_feed.php?where=category&what=love

// $where = isset($_GET['where']) ?
// 	" WHERE id = '{$_GET['where']}' " : "";
// $wherewhat = getDefault(
// 	['where','what'],
// 	" WHERE %s = '%s' ",
// 	// % means a string
// 	""
// );
$table = getDefault(['table'], " `%s` ", " test ");
$select = getDefault(['select'], " %s ", " * ");


$wherewhat = getDefault(['where','what'], " WHERE `%s` = '%s' ", "");
// ``is making sure it works 
$wherein = getDefault(['where','in'], " WHERE `%s` IN (%s) ", "");
$limit = getDefault(['limit'], " LIMIT %d ", " LIMIT 12 ");
// limit 12 item
$orderby = getDefault(['orderby','direction'], " ORDER BY %s %s ", " ORDER BY date_create DESC ");
//showing the only data that you want but 12 item
$wherelike = areset(['where','like']) ?
	likeGroup($_GET['where'],$_GET['like']) : 
	"";



$qry_string = "
SELECT $select FROM $table
$wherewhat
$wherein
$wherelike
$orderby
$limit

";


$data = getQueryResults(
	$conn,
	$qry_string


);

// print_p($data);

die(json_encode(
	// $data,
	// // show the number instead of string
	
	[
		"sql" =>$qry_string,
		"data" =>$data
	],
	JSON_NUMERIC_CHECK
));
?>