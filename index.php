<?php 

 if($_REQUEST['key'] == md5('detection')){
 	include('detection.php');
 }else{
 	$array = array(
 		'status'=>0,
 		'message'=>'Bad Request'
 	);


 	$info =  mysqli_get_host_info($connection);
	$time = date_default_timezone_get();

	$current_data = file_get_contents("userlog/user_log.json");
    $array_data = json_decode($current_data, JSON_HEX_APOS);  

	$arr = array(
		'request_method' => $_SERVER['REQUEST_METHOD'],
		'server_info'=> $_SERVER['SERVER_NAME'],
		'user_server_ip' => $_SERVER['SERVER_ADDR'],
		'user_agent'=> $_SERVER['HTTP_USER_AGENT'],
		'ip_address'=> $_SERVER['REMOTE_ADDR'],
		'user_timezone'=> $time,
		'url_page'=> $_SERVER['HTTP_REFERER'],
		'request_time' =>$_SERVER['REQUEST_TIME'],
		'user_key' => $_REQUEST['key'],
		'status' => 'Invalid Key',
	);

	$array_data[] = $arr;
	$arr = json_encode($array_data);
	file_put_contents("userlog/user_log.json", $arr);
	print_r(file_get_contents("userlog/user_log.json"));

    echo json_encode($array);
 }    

?>