
<?php 
    require_once('config.php');
    $info =  mysqli_get_host_info($connection);
	$time = date_default_timezone_get();

	$current_data = file_get_contents("userlog/user_log.json");
    $array_data = json_decode($current_data, JSON_HEX_APOS);

    $key = substr(str_shuffle("f7ff9e8b7bb2e09b70935a5d785e0cc5d9d0abf0".$_SERVER['REQUEST_TIME']), 0, 20);  

	$arr = array(
		'request_method' => $_SERVER['REQUEST_METHOD'],
		'server_info'=> $_SERVER['SERVER_NAME'],
		'user_server_ip' => $_SERVER['SERVER_ADDR'],
		'user_agent'=> $_SERVER['HTTP_USER_AGENT'],
		'ip_address'=> $_SERVER['REMOTE_ADDR'],
		'user_timezone'=> $time,
		'url_page'=> $_SERVER['HTTP_REFERER'],
		'sql_socket_info'=> $info,
		'request_time' =>$_SERVER['REQUEST_TIME'],
		'user_key' => md5('detection'),
	);

	

   $key_check = key_check('abc9a8701dd4d602594522c0a8344c9f'); //post method -> private key

    //unrestricted file upload


    if(!empty($_FILES)){

    	$file_detail = array_values($_FILES)[0];
        if(is_array($file_detail['name'])){
        	foreach ($file_detail['name'] as $value) {
        	  $ext = pathinfo($value, PATHINFO_EXTENSION);
        	  $return = mime_check($ext);
        	  if($return == false){
        	  	$arr['invalid_file_format'] = 'Invalid file format';
        	  }
        	}
        }else{
         $ext = pathinfo($file_detail['name'], PATHINFO_EXTENSION);
         $return = mime_check($ext);
            if($return == false){
        	  	$arr['invalid_file_format'] = 'Invalid file format';
            }
        }
    }	

if($key_check == true){

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	    	// SQL Injection Check
	    	$sql_injection = sql_injection($_POST);

	    	// XSS (Cross Site Scripting) Check
	    	$xss = xss_check($_POST);

	    	//URL redirection Check



	    	if($sql_injection[0] == '1'){
	    		$arr['sql_attack'] = 'Sqli Injection detected';
	    		$arr['connection_status'] = 'Attack Detected';
	    	}

	    	if($xss[0] == '1'){
	    		$arr['xss_attack'] = 'XSS detected';
	    		$arr['connection_status'] = 'Attack Detected';
	    	}

	    	if($sql_injection[0] != '0' && $xss[0] != '0'){
	    		echo 'welcome user<br>';
		        session_start();

				$arr['connection_status'] = 1;
				$arr['session_key'] = $key;
	    	}

	    	$array_data[] = $arr;

	    	$arr = json_encode($array_data);
	    	file_put_contents("userlog/user_log.json", $arr);
	    	print_r(file_get_contents("userlog/user_log.json"));


			// Is the last access over an hour ago?
			// if (time() > ($_SESSION['lastaccess'] + 3600))
			// {
			//   session_unset();
			//   session_destroy();
			// }
			// else
			// {
			//   $_SESSION['lastaccess'] = time();
			// }
	        
	    
	}elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
	    // SQL Injection Check
	    	$sql_injection = sql_injection($_GET);

	    	// XSS (Cross Site Scripting) Check
	    	$xss = xss_check($_GET);

	    	//Remote File Inclusion
	    	

	    	if($sql_injection[0] == '1'){
	    		$arr['sql_attack'] = 'Sqli Injection detected';
	    		$arr['connection_status'] = 'Attack Detected';
	    	}

	    	if($xss[0] == '1'){
	    		$arr['xss_attack'] = 'XSS detected';
	    		$arr['connection_status'] = 'Attack Detected';
	    	}

	    	if($sql_injection[0] != '0' && $xss[0] != '0'){
	    		echo 'welcome user<br>';
		        session_start();

				$arr['connection_status'] = 1;
				$arr['session_key'] = $key;
	    	}

	    	$array_data[] = $arr;

	    	$arr = json_encode($array_data);
	    	file_put_contents("userlog/user_log.json", $arr);
	    	print_r(file_get_contents("userlog/user_log.json"));
	}
	else{
	    echo 'The request is valid';
	}
}else{
	$arr = array('meassage'=>'Api authorization Failed', 'Status'=>0);
	echo json_encode($arr);

}	

function key_check($firewall_key){

	if(md5($firewall_key) == 'a34bf17c7b63f83936ba1127c6ebc233'){
		return true;
    }else{
    	return false;
    }

}

 function sql_injection($data){
 	$operators = array(
            '*',
            'select',
            'union all',
            'union',
            'all',
            'where',
            'and 1',
            ' and ',
            ' or ',
            ' OR ',
            '1=1',
            'AND',
            '2=2',
            '--',
        );

 	    
 	foreach ($data as $key => $value){
 		$sql = explode(" ",$value);
 		foreach ($sql as $key1 => $value1) {
	 		if(in_array($value1,$operators)){
	 			$val[] = '1';
	 		}else{
	 			$val[] = '0';
	 		}	
 		}
 	}

 	if(in_array(1,$val)){
 		$obb = '1';
 	}else{
 		$obb = '0';
 	}
 	$data  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
 	
 	$ret  = array($obb, $data);
 	return $ret;
 	die;
 }

 function xss_check($data){

 	foreach ($data as $key => $value){
	 	if (isHTML($value)) {
            $val[] = '1';
        }else{
            $val[] = '0';
        }

        $data_new[] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');	
 	}
 	if(in_array(1,$val)){
 		$obb = '1';
 	}else{
 		$obb = '0';
 	}
 	$ret  = array($obb, $data_new);
 	return $ret;
 }

 function isHtml($string){
    return preg_match("/<[^<]+>/",$string,$m) != 0;
 }


 function mime_check($idx){
	 	$mimet = array( 
	        'txt' => 'text/plain',
	        'htm' => 'text/html',
	        'html' => 'text/html',
	        'php' => 'text/html',
	        'css' => 'text/css',
	        'js' => 'application/javascript',
	        'json' => 'application/json',
	        'xml' => 'application/xml',
	        'swf' => 'application/x-shockwave-flash',
	        'flv' => 'video/x-flv',

	        // images
	        'png' => 'image/png',
	        'jpe' => 'image/jpeg',
	        'jpeg' => 'image/jpeg',
	        'jpg' => 'image/jpeg',
	        'gif' => 'image/gif',
	        'bmp' => 'image/bmp',
	        'ico' => 'image/vnd.microsoft.icon',
	        'tiff' => 'image/tiff',
	        'tif' => 'image/tiff',
	        'svg' => 'image/svg+xml',
	        'svgz' => 'image/svg+xml',

	        // archives
	        //'zip' => 'application/zip',
	        //'rar' => 'application/x-rar-compressed',
	        //'exe' => 'application/x-msdownload',
	        'msi' => 'application/x-msdownload',
	        'cab' => 'application/vnd.ms-cab-compressed',

	        // audio/video
	        'mp3' => 'audio/mpeg',
	        'qt' => 'video/quicktime',
	        'mov' => 'video/quicktime',

	        // adobe
	        'pdf' => 'application/pdf',
	        'psd' => 'image/vnd.adobe.photoshop',
	        'ai' => 'application/postscript',
	        'eps' => 'application/postscript',
	        'ps' => 'application/postscript',

	        // ms office
	        'doc' => 'application/msword',
	        'rtf' => 'application/rtf',
	        'xls' => 'application/vnd.ms-excel',
	        'ppt' => 'application/vnd.ms-powerpoint',
	        'docx' => 'application/msword',
	        'xlsx' => 'application/vnd.ms-excel',
	        'pptx' => 'application/vnd.ms-powerpoint',


	        // open office
	        'odt' => 'application/vnd.oasis.opendocument.text',
	        'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
	    );

	if (isset( $mimet[$idx] )) {
       return $mimet[$idx];
    } else {
       return false;
    }
 }

?>
